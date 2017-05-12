<?php namespace App\Models\Enums;

abstract class RequesterStat {
  const PendingPayment = 'P';
  const Active = 'A';
  const Inactive = 'I';
  const Delete = 'D';

  static $values = [
    self::Active=>'Active',
    self::Inactive=>'Inactive',
    self::Delete=>'Delete',
  ];
}


