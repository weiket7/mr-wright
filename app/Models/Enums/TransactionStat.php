<?php namespace App\Models\Enums;

abstract class TransactionStat {
  const Pending = 'P';
  const Success = 'S';
  const Cancelled = 'C';
  const Failed = 'F';
  const Error = 'E';

  static $values = [
    self::Pending=>'Pending',
    self::Success=>'Success',
    self::Cancelled=>'Cancelled',
    self::Failed=>'Failed',
    self::Error=>'Error',
  ];
}
