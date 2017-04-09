<?php namespace App\Models\Enums;

abstract class UserType {
  const User = 'U';
  const Operator = 'O';

  static $values = [
    self::User=>'User',
    self::Operator=>'Operator',
  ];
}


