<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;
  protected $table = 'user';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $primaryKey = 'user_id';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function getRequesterAccess($username)
  {
    $requester = Requester::where('username', $username)->first();
    return [
      'company_id' => $requester->company_id,
      'office_id' => $requester->office_id,
    ];
   }
}
