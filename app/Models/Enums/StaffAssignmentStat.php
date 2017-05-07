<?php namespace App\Models\Enums;

abstract class StaffAssignmentStat {
  const Pending = 'P';
  const Attended = 'A';
  const Completed  = 'C';

  static $values = [
    self::Pending=>'Pending',
    self::Attended=>'Attended',
    self::Completed=>'Completed',
  ];
}


