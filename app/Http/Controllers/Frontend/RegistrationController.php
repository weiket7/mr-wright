<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Entities\TransactionRequest;
use App\Models\Enums\MembershipStat;
use App\Models\Enums\PaymentMethodStat;
use App\Models\Enums\TransactionStat;
use App\Models\Enums\TransactionType;
use App\Models\Membership;
use App\Models\PaymentMethod;
use App\Models\Services\PaymentService;
use Illuminate\Http\Request;
use Log;

class RegistrationController extends Controller
{
  public function index(Request $request)
  {
    $membership_id = $request->get('membership_id'); //at Membership->Register, there is ?membership_id=X
    if (!empty($membership_id) && Membership::where('membership_id', $membership_id)->count() == 0) {
      return view('frontend/error', ['error' => 'Membership does not exist']);
    }
    
    $account_service = new Registration();
    if ($request->isMethod("post")) {
      $input = $request->all();
      if ($account_service->validateRegistration($input) == false) {
        return redirect()->back()->withErrors($account_service->getValidation())->withInput($input);
      }
      
      $registration = $account_service->saveRegistration($input, $request->ip());
      $request->session()->put('registration_id', $registration->registration_id);
  
      if ($membership_id) {
        $membership = Membership::find($membership_id);
        if ($membership->free_trial) {
          $registration = $account_service->saveMembershipFreeTrial($registration, $membership);
          $account_service->approveRegistration($registration);
          $account_service->emailRegistration($registration);
          return redirect('register/success');
        }
      }
      
      $uen_exist = $account_service->uenExist($input['uen']);
      if ($uen_exist) {
        return redirect('register/existing-uen');
      }
      return redirect('register/membership')->with('membership_id', $membership_id);
    }
    
    $data['membership_id'] = $membership_id;
    return view("frontend/register", $data);
  }
  
  public function membership(Request $request) {
    $registration_id = $request->session()->get('registration_id');
    
    $account_service = new Registration();
    if ($request->isMethod("post")) {
      $input = $request->all();
  
      if ($account_service->validateSaveRegistrationMembership($input) == false) {
        return redirect()->back()->withErrors($account_service->getValidation())->withInput($input);
      }
      
      $registration = Registration::find($registration_id);
      $membership = Membership::find($input["membership_id"]);
      if ($membership->free_trial) {
        $registration = $account_service->saveMembershipFreeTrial($registration, $membership);
        $account_service->approveRegistration($registration);
        $account_service->emailRegistration($registration);
      } else {
        $account_service->saveRegistrationMembership($registration, $membership, $input);
      }
    
      if ($registration->payment_method == PaymentMethod::CREDIT_CARD) { //credit card
        $transaction_request = new TransactionRequest();
        $transaction_request->code = $registration->registration_code;
        $transaction_request->type = TransactionType::Registration;
        $transaction_request->stat = TransactionStat::Pending;
        $transaction_request->amount = $registration->effective_price;
        return redirect('payment')->with('transaction_request', $transaction_request);
      }

      $account_service->emailRegistration($registration);
      return redirect('register/success');
    }
    $membership_service = new Membership();
    $data['memberships'] = $membership_service->getMembershipAll(MembershipStat::Active)->keyBy('membership_id');
    $payment_service = new PaymentService();
    $data['payment_methods'] = $payment_service->getPaymentMethods(PaymentMethodStat::Active)->toArray();
    return view('frontend/register-membership', $data);
  }
  
  public function existingUen(Request $request)
  {
    $registration_id = $request->session()->get('registration_id');
    if ($request->isMethod("post")) {
      $account_service = new Registration();
      $registration = $account_service->registerExistingUen($registration_id);
      $account_service->emailRegisterExistingUen($registration);
      $account_service->emailRegistration($registration);
      return redirect('register/success');
    }
    return view('frontend/register-existing-uen');
  }
  
  public function success(Request $request)
  {
    $code = $request->get('code');
    $registration = Registration::findOrFail($request->session()->get('registration_id'));
    $data['registration'] = $registration;
    $data['code'] = $code;
    return view("frontend/register-success", $data);
  }
  
}
