<?php namespace App\Models;

use App\Models\Helpers\BackendHelper;
use Eloquent, DB, Validator, Log;

class FrontendFile extends Eloquent
{
  public $table = 'frontend_file';
  protected $primaryKey = 'frontend_file_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  public $timestamps = false;

  public function saveFrontendFile($input) {
    if (isset($input['value'])) {
      $file_name = BackendHelper::uploadFile("", $this->removeFileExtension($this->file_name), $input['value']);
    }
  }
  
  private function removeFileExtension($file_name) {
    return preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_name);
  }
}