<?php

namespace App\Models\Services;

use App\Models\Entities\TransactionRequest;
use App\Models\Enums\TransactionStat;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use Carbon\Carbon;
use DB;

class PaymentService
{
  public function createTransaction($transaction_request) {
    $transaction = new Transaction();
    $transaction->code = $transaction_request->code;
    $transaction->type = $transaction_request->type;
    $transaction->stat = $transaction_request->stat;
    $transaction->amount = $transaction_request->amount;
    $transaction->save();
    return true;
  }

  public function saveTransaction($code, $response_code) {
    $transaction = $this->getTransaction($code);
    $transaction->stat = $this->responseCodetoStat($response_code);
    $transaction->save();
    return $transaction;
  }

  public function getPaymentMethods($stat = null) {
    $payment_methods = PaymentMethod::orderBy('position');
    if ($stat) {
      $payment_methods->where('stat', $stat);
    }
    return $payment_methods->select(['name', 'value'])->get();
  }

  private function responseCodetoStat($response_code) {
    if ($response_code == 0) {
      return TransactionStat::Success;
    }
    if ($response_code == 1) {
      return TransactionStat::Failed;
    }
    return TransactionStat::Error;
  }

  public function getTransaction($code) {
    return Transaction::where('code', $code)->firstOrFail();
  }
}