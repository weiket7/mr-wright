<?php namespace App\Models;

use App\Mail\ForgotPasswordMail;
use App\Models\Enums\ForgotPasswordStat;
use App\Models\Enums\UserType;
use Eloquent, DB, Validator, Log;
use Hash;
use Mail;

class ForgotPassword extends Eloquent
{
  public $table = 'forgot_password';
  protected $primaryKey = 'forgot_password_id';
  protected $validation;
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  
  private $rules = [
    'email'=>'required',
  ];
  
  private $messages = [
    'email.required'=>'Email is required',
  ];
  
  public function saveForgotPasswordAndEmail($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
  
    $this->token = str_random(20);
    $this->email = $input['email'];
    $user = User::where('email', $input['email'])->where('type', UserType::Requester)->first();
    if ($user == null) {
      $this->stat = ForgotPasswordStat::Invalid;
    } else {
      $new_password = str_random(8);
      $this->stat = ForgotPasswordStat::Valid;
      $user->password = Hash::make($new_password);
      $user->save();

      Mail::to($user)->send(new ForgotPasswordMail($user->name, $user->email, $new_password));
    }
    $this->save();

    return $this;
  }


  public function getValidation() {
    return $this->validation;
  }

}