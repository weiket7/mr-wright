<?php namespace App\Models\Enums;

abstract class UserType {
  const Requester = 'R';
  const Operator = 'O';

  static $values = [
    ''=>'',
    self::Requester=>'Requester',
    self::Operator=>'Operator',
  ];
}


