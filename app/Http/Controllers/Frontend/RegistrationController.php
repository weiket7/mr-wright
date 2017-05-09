<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Entities\TransactionRequest;
use App\Models\Enums\MembershipStat;
use App\Models\Enums\PaymentMethodStat;
use App\Models\Enums\TransactionStat;
use App\Models\Enums\TransactionType;
use App\Models\Membership;
use App\Models\Registration;
use App\Models\Services\PaymentService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
  public function index(Request $request)
  {
    $membership_id = $request->get('membership_id');
    if (! empty($membership_id) && Membership::where('membership_id', $membership_id)->count() == 0) {
      return view('frontend/error', ['error'=>'Membership does not exist']);
    }

    $register = new Account();
    if ($request->isMethod("post")) {
      $input = $request->all();
      $validate = $register->validateRegistration($input) == false;
      if ($validate) {
        return redirect()->back()->withErrors($register->getValidation())->withInput($input);
      }

      $registration = $register->saveRegistration($input, $request->ip());
      $request->session()->put('registration_id', $registration->registration_id);

      $uen_exist = $register->uenExist($input['uen']);
      if ($uen_exist) {
        return redirect('register/existing-uen');
      }
      return redirect('register/membership')->with('membership_id', $membership_id);
    }

    $data['membership_id'] = $membership_id;
    return view("frontend/register", $data);
  }

  public function membership(Request $request)
  {
    $registration_id = $request->session()->get('registration_id');
    $registration = Registration::findOrFail($registration_id);

    $account_service = new Account();
    if ($request->isMethod("post")) {
      $registration = $account_service->saveRegistrationMembership($registration_id, $request->all());
      if ($registration->payment_method == 'R') { //credit card
        $transaction_request = new TransactionRequest();
        $transaction_request->code = $registration->registration_code;
        $transaction_request->type = TransactionType::Registration;
        $transaction_request->stat = TransactionStat::Pending;
        $transaction_request->amount = $registration->effective_price;
        return redirect('payment')->with('transaction_request', $transaction_request);
      } else {
        $account_service->emailRegistration($registration);
      }
      
      return redirect('register/success');
    }
    $membership_service = new Membership();
    $data['memberships'] = $membership_service->getMembershipDropdown(MembershipStat::Active);
    $payment_service = new PaymentService();
    $data['payment_methods'] = $payment_service->getPaymentMethods(PaymentMethodStat::Active);
    return view('frontend/register-membership', $data);
  }

  public function existingUen(Request $request) {
    $registration_id = $request->session()->get('registration_id');
    if ($request->isMethod("post")) {
      $account_service = new Account();
      $registration = $account_service->registerExistingUen($registration_id);
      $account_service->emailRegisterExistingUen($registration);
      $account_service->emailRegistration($registration);
      return redirect('register/success');
    }
    return view('frontend/register-existing-uen');
  }

  public function success(Request $request) {
    $code = $request->get('code');
    $registration = Registration::findOrFail($request->session()->get('registration_id'));
    $data['registration'] = $registration;
    $data['code'] = $code;
    return view("frontend/register-success", $data);
  }
}
