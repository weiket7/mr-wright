<?php namespace App\Models\Enums;

abstract class Role {
  const Admin = 'A';
  const Finance = 'F';
  const Operator = 'O';
  const Staff = 'S';
  const Requester = 'R';

  static $values = [
    self::Admin=>'Admin',
    self::Finance=>'Finance',
    self::Operator=>'Operator',
    self::Staff=>'Staff',
    self::Requester=>'Requester',
  ];
}


