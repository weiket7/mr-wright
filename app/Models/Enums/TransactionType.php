<?php namespace App\Models\Enums;

abstract class TransactionType {
  const Registration = 'R';
  const Ticket = 'T';
  //const Recurring = 'C';

  static $values = [
    self::Registration=>'Registration',
    self::Ticket=>'Ticket',
    //self::Recurring=>'Recurring',
  ];
}
