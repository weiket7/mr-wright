<?php namespace App\Models\Enums;

abstract class RegistrationStat {
  const Pending = 'E';
  const Paid = 'P';
  const Approved = 'A';
  const Rejected = 'R';

  static $values = [
    self::Pending=>'Pending',
    self::Paid=>'Paid',
    self::Approved=>'Approved',
    self::Rejected=>'Rejected',
  ];
}


