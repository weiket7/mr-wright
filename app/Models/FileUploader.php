<?php
class FileUploader {
  public static function uploadImage($folder, $name, $image) {
    if (App::environment('local')) {
      $base_path = $_SERVER['DOCUMENT_ROOT'] . "/mrwright/assets/images/";
    } else {
      $base_path = $_SERVER['DOCUMENT_ROOT'] . "/assets/images/";
    }

    $destination_path = $base_path . $folder . "/";
    $file_name = str_slug($name).'.'.$image->getClientOriginalExtension();
    $image->move($destination_path, $file_name);
    return $file_name;
  }
}