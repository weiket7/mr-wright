<?php namespace App\Models\Enums;

abstract class TicketOtpType {
  const First = 'H';
  const Second = 'M';
  
  static $values = [
    self::High=>'High',
    self::Medium=>'Medium',
    self::Low=>'Low',
  ];
}


  