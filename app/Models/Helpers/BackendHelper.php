<?php namespace App\Models\Helpers;

class BackendHelper
{
  public static function getIdFromArr($arr, $id_name) {
    $data = [];
    foreach($arr as $a) {
      if ($a->$id_name != '' && $a->$id_name != null) {
        $data[] = $a->$id_name;
      }
    }
    return $data;
  }

  public static function stringContains($target, $value) {
    if (stripos($target, $value) !== false) {
      return true;
    }
    return false;
  }
}