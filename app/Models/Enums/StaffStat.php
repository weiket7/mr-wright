<?php namespace App\Models\Enums;

abstract class StaffStat {
  const Active = 'A';
  const Inactive = 'I';

  static $values = [
    self::Active=>'Active',
    self::Inactive=>'Inactive',
  ];
}


