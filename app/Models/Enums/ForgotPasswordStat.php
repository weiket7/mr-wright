<?php namespace App\Models\Enums;

abstract class ForgotPasswordStat {
  const Invalid = 'I';
  const Valid = 'V';
  const Consumed = 'C';

  static $values = [
    self::Invalid=>'Invalid',
    self::Valid=>'Valid',
    self::Consumed=>'Consumed',
  ];
}


