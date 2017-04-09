<?php namespace App\Models\Enums;

abstract class PaymentMethod {
  const Cash = 'C';
  const Nets = 'N';
  const CreditCard = 'R';
  const Bank = 'B';
  const Cheque = 'Q';
  const Paypal = 'P';

  static $values = [
    self::Cash=>'Cash',
    self::Nets=>'Nets',
    self::CreditCard=>'CreditCard',
    self::Bank=>'Bank',
    self::Cheque=>'Cheque',
    self::Paypal=>'Paypal',
  ];
}