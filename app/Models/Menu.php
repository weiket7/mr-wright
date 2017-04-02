<?php namespace App\Models;

class Menu {
  public static function getMenu() {
    $menu = [
      ['link' => "/", 'name'=>'Dashboard', 'icon'=>'icon-home'],
      ['link' => "company", 'name'=>'Companies', 'icon'=>'icon-plane'],
      ['link' => "office", 'name'=>'Offices', 'icon'=>'icon-direction'],
      ['link' => "requester", 'name'=>'Requesters', 'icon'=>'icon-users'],
      ['link' => "staff", 'name'=>'Staffs', 'icon'=>'icon-wrench'],
      ['link' => "ticket", 'name'=>'Tickets', 'icon'=>'icon-note'],
      /*['link' => "quotation", 'name'=>'Quotations', 'icon'=>''],*/
      ['link' => "invoice", 'name'=>'Invoices', 'icon'=>'icon-calculator'],
      ['link' => "operator", 'name'=>'Operators', 'icon'=>'icon-eyeglasses'],
      ['name'=>'Reports', 'icon'=>'icon-bar-chart', 'sub'=>[
        ['link'=>'report/ticket', 'name'=>'Tickets', 'icon'=>''],
      ]],
      ['name'=>'Settings', 'icon'=>'icon-settings', 'sub'=>[
        ['link'=>'skill', 'name'=>'Skills'],
        ['link'=>'role', 'name'=>'Roles'],
        ['link'=>'access', 'name'=>'Accesses'],
        ['link'=>'category-for-ticket', 'name'=>'Categories for Ticket'],
        ['link'=>'working-day-time', 'name'=>'Working Day Times'],
        ['link'=>'blocked-date', 'name'=>'Blocked Dates'],
        ['link'=>'blocked-date-time', 'name'=>'Blocked Date Times'],
        ['link'=>'setting', 'name'=>'Settings'],
        ['link'=>'system', 'name'=>'System'],
      ]],
    ];
    return $menu;
  }
}