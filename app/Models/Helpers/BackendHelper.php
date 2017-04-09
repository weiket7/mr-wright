<?php namespace App\Models\Helpers;

use App;
use Carbon\Carbon;

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
    if (stripos($target, trim($value)) !== false) {
      return true;
    }
    return false;
  }

  public static function uploadFile($folder, $name, $image) {
    $base_path = self::getDir();
    $destination_path = $base_path . $folder . "/";
    $file_name = str_slug($name).'.'.$image->getClientOriginalExtension();
    $image->move($destination_path, $file_name);
    return $file_name;
  }

  public static function getDir() {
    if (App::environment('local')) {
      $base_path = $_SERVER['DOCUMENT_ROOT'] . "/mrwright/public/";
    } else {
      $base_path = $_SERVER['DOCUMENT_ROOT'] . "/public/";
    }
    return $base_path;
  }

  private function arrayContains($haystack, $needle) {
    //http://nickology.com/2012/07/03/php-faster-array-lookup-than-using-in_array/
    if (isset($haystack[$needle]))
    {
      return true;
    }
    return false;
  }

  public static function dateBeforeDateInclusive($date1, $date2) {
    if (is_string($date1)) {
      $date1 = Carbon::createFromFormat('Y-m-d H:i:s', $date1);
    }
    if (is_string($date2)) {
      $date2 = Carbon::createFromFormat('Y-m-d', $date2);
    }
    return $date1->lte($date2);
  }
}