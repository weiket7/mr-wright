<?php namespace App\Models\Enums;

abstract class RequesterStat {
  const Active = 'A';
  const Inactive = 'I';

  static $values = [
    ''=>'',
    self::Active=>'Active',
    self::Inactive=>'Inactive',
  ];
}


