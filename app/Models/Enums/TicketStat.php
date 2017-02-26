<?php namespace App\Models\Enums;

abstract class TicketStat {
  const Open = 'O';
  const Acknowledged = 'A';
  const Completed = 'C';
  const Paid = 'P';
  
  static $values = [
    ''=>'',
    self::Open=>'Open',
    self::Acknowledged=>'Acknowledged',
    self::Completed=>'Completed',
    self::Paid=>'Paid',
  ];
}


