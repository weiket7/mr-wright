<?php namespace App\Models\Enums;

abstract class TicketStat {
  const Drafted = 'O';
  const Opened = 'O';
  const Quoted = 'Q';
  const Accepted = 'A';
  const Declined = 'D';
  const Completed = 'C';
  const Invoiced = 'I';
  const Paid = 'P';
  
  static $values = [
    self::Drafted=>'Drafted',
    self::Opened=>'Opened',
    self::Quoted=>'Quoted',
    self::Accepted=>'Accepted',
    self::Declined=>'Declined',
    self::Completed=>'Completed',
    self::Invoiced=>'Invoiced',
    self::Paid=>'Paid',
  ];
}


