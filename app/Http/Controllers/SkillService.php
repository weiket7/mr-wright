<?php

namespace App\Models\Services;

use Carbon\Carbon;
use DB;

class SkillService
{

  public function getSkillAll()
  {
    return DB::table('skill')->pluck('name');
  }
}