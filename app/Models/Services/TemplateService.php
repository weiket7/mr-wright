<?php

namespace App\Models\Services;

use Carbon\Carbon;
use DB;
use App\Models\Product;

class ProductService
{
  public function getProductAll() {
    return Product::all();
  }

  public function getProductDropdown() {
    return Product::pluck('name', 'company_id');
  }

  public function getProduct($company_id) {
    $company = Product::findOrNew($company_id);
    return $company;
  }
}