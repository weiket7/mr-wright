<?php namespace App\Models;

use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Size extends Eloquent
{
  protected $collection = 'product';
  public $timestamps = false;

}