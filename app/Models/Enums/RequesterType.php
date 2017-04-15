<?php namespace App\Models\Enums;

abstract class RequesterType {
  const Individual = 'I';
  const Corporate = 'C';

  static $values = [
    self::Individual=>'Individual',
    self::Corporate=>'Corporate',
  ];
}


