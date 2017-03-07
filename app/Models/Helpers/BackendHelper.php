<?php namespace App\Models\Helpers;

use App;

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

  public static function uploadFile($folder, $name, $image) {
    if (App::environment('local')) {
      $base_path = $_SERVER['DOCUMENT_ROOT'] . "/mrwright/public/";
    } else {
      $base_path = $_SERVER['DOCUMENT_ROOT'] . "/public/";
    }

    $destination_path = $base_path . $folder . "/";
    $file_name = str_slug($name).'.'.$image->getClientOriginalExtension();
    $image->move($destination_path, $file_name);
    return $file_name;
  }
}