<?php namespace App\Models\Enums;

abstract class AccessType {
  const Module = 'M';
  const Feature = 'F';
  
  static $values = [
    self::Module=>'Module',
    self::Feature=>'Feature',
  ];
}


