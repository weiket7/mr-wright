<?php namespace App\Models\Enums;

abstract class RequesterStat {
  //const Pending = 'P';
  const Active = 'A';
  const Inactive = 'I';

  static $values = [
    //self::Pending=>'Pending',
    self::Active=>'Active',
    self::Inactive=>'Inactive',
  ];
}


