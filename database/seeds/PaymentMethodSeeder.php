<?php

use App\Models\Enums\PaymentMethodStat;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
  public function run()
  {
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Active, 'name'=>'Cash', 'value'=>'C', 'pos'=>1,
    ]);
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Active, 'name'=>'NETS', 'value'=>'N', 'pos'=>2,
    ]);
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Active, 'name'=>'Credit Card', 'value'=>'R', 'pos'=>3,
    ]);
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Active, 'name'=>'Bank', 'value'=>'B', 'pos'=>4,
    ]);
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Active, 'name'=>'Cheque', 'value'=>'Q', 'pos'=>5,
    ]);
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Active, 'name'=>'Paypal', 'value'=>'P', 'pos'=>6,
    ]);
  }
}
