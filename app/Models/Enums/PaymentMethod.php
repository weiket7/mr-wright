<?php namespace App\Models\Enums;

abstract class PaymentMethod {
  const CreditCard = 'R';
  const NETS = 'N';
  const Cash = 'C';
  const BankTransfer = 'B';
  const Cheque = 'Q';
  
  static $values = [
    self::CreditCard=>'CreditCard',
    self::NETS=>'NETS',
    self::Cash=>'Cash',
    self::BankTransfer=>'BankTransfer',
    self::Cheque=>'Cheque',
  ];
}


