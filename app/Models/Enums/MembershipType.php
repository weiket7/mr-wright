<?php namespace App\Models\Enums;

abstract class MembershipType {
  const Yearly = 'Y';
  const Monthly = 'M';
  const Unlimited = 'U';
  
  static $values = [
    self::Yearly=>'Yearly',
    self::Monthly=>'Monthly',
    self::Unlimited=>'Unlimited',
  ];
}
