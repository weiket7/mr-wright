<?php namespace App\Models\Enums;

abstract class RegistrationStat {
  const Pending = 'E';
  const Paid = 'P';
  const Approved = 'A';

  static $values = [
    self::Pending=>'Pending',
    self::Paid=>'Paid',
    self::Approved=>'Approved',
  ];
}


