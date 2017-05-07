<?php namespace App\Models\Enums;

abstract class UserType {
  const Operator = 'O';
  const Requester = 'R';
  const Staff = 'S';

  static $values = [
    self::Operator=>'Operator',
    self::Requester=>'Requester',
    self::Staff=>'Staff',
  ];
}


