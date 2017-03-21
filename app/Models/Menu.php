<?php namespace App\Models;

class Menu {
  public static function getMenu() {
    $menu = [
      ['link' => "/", 'name'=>'Dashboard'],
      ['link' => "company", 'name'=>'Companies'],
      ['link' => "office", 'name'=>'Offices'],
      ['link' => "requester", 'name'=>'Requesters'],
      ['link' => "staff", 'name'=>'Staffs'],
      ['link' => "skill", 'name'=>'Skills'],
      ['link' => "ticket", 'name'=>'Tickets'],
      ['link' => "quotation", 'name'=>'Quotations'],
      ['link' => "invoice", 'name'=>'Invoices'],
      ['link' => "operator", 'name'=>'Operators'],
      ['name'=>'Reports', 'sub'=>[
        ['link'=>'report/ticket', 'name'=>'Tickets'],
      ]],
      ['name'=>'Working Hours', 'sub'=>[
        ['link'=>'working-day-time', 'name'=>'Working Day Times'],
        ['link'=>'blocked-date', 'name'=>'Blocked Dates'],
        ['link'=>'blocked-date-time', 'name'=>'Blocked Date Times'],
      ]],
    ];
    return $menu;
  }
}