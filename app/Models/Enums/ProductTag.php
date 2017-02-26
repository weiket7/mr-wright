<?php namespace App\Models\Enums;

abstract class ProductTag {
  const Fresh = 'F';
  const Hot = 'F';
  
  static $values = [
    ''=>'',
    self::Fresh=>'Available',
    self::Hot=>'Available',
  ];
}


