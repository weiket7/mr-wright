<?php namespace App\Models\Enums;

abstract class TicketPriority {
  //const Critical = 'C';
  const High = 'H';
  const Medium = 'M';
  const Low = 'L';

  static $values = [
    self::High=>'High',
    self::Medium=>'Medium',
    self::Low=>'Low',
  ];
}


  