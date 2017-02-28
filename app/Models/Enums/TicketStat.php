<?php namespace App\Models\Enums;

abstract class TicketStat {
  const Opened = 'O';
  const Quoted = 'Q';
  const Accepted = 'A';
  const Completed = 'C';
  const Invoiced = 'I';
  const Paid = 'P';
  
  static $values = [
    ''=>'',
    self::Opened=>'Opened',
    self::Quoted=>'Quoted',
    self::Accepted=>'Accepted',
    self::Completed=>'Completed',
    self::Invoiced=>'Invoiced',
    self::Paid=>'Paid',
  ];
}


