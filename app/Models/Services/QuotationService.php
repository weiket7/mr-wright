<?php

namespace App\Models\Services;

use App\Models\Quotation;
use Carbon\Carbon;
use DB;

class QuotationService
{
  public function getQuotation($quotation_id) {
    return Quotation::findOrNew($quotation_id);
  }
}