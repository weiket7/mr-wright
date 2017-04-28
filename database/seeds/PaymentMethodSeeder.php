<?php

use App\Models\Enums\PaymentMethodStat;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
  public function run()
  {
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Active, 'name'=>'Cash', 'value'=>'C', 'position'=>3,
    ]);
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Inactive, 'name'=>'NETS', 'value'=>'N', 'position'=>2,
    ]);
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Active, 'name'=>'Credit Card', 'value'=>'R', 'position'=>1,
    ]);
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Active, 'name'=>'Bank', 'value'=>'B', 'position'=>4,
    ]);
    DB::table('payment_method')->insert(
      ['stat'=>PaymentMethodStat::Active, 'name'=>'Cheque', 'value'=>'Q', 'position'=>5,
    ]);
  }
}
