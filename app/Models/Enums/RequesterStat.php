<?php namespace App\Models\Enums;

abstract class RequesterStat {
  const PendingPayment = 'P';
  const Active = 'A';
  const Inactive = 'I';

  static $values = [
    self::PendingPayment=>'Pending Payment',
    self::Active=>'Active',
    self::Inactive=>'Inactive',
  ];
}


