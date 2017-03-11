<?php namespace App\Models\Enums;

abstract class PreferredContact {
  const Mobile = 'M';
  const Email = 'E';
  const Office = 'O';

  static $values = [
    self::Mobile=>'Mobile',
    self::Email=>'Email',
    self::Office=>'Office',
  ];
}