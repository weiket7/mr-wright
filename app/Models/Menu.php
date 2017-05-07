<?php namespace App\Models;

use App\Models\Enums\UserType;

class Menu {
  public static function getMenu($user_type) {
    if ($user_type == UserType::Staff) {
      return self::getStaffMenu();
    } else if ($user_type == UserType::Operator) {
      return self::getOperatorMenu();
    }
  }

  private static function getOperatorMenu() {
    $menu = [
      ["link"=>"admin/dashboard", "name"=>"Dashboard", "icon"=>"icon-home"],
      ["link"=>"admin/registration", "name"=>"Registrations", "icon"=>"icon-eyeglasses"],
      ["link"=>"admin/company", "name"=>"Companies", "icon"=>"icon-plane"],
      ["link"=>"admin/office", "name"=>"Offices", "icon"=>"icon-direction"],
      ["link"=>"admin/requester", "name"=>"Requesters", "icon"=>"icon-users"],
      ["link"=>"admin/staff", "name"=>"Staffs", "icon"=>"icon-wrench"],
      ["link"=>"admin/ticket", "name"=>"Tickets", "icon"=>"icon-note"],
      /*["link"=>"admin/quotation", "name"=>"Quotations", "icon"=>""],*/
      ["link"=>"admin/invoice", "name"=>"Invoices", "icon"=>"icon-calculator"],
      ["link"=>"admin/operator", "name"=>"Operators", "icon"=>"icon-eyeglasses"],
      ["name"=>"Reports", "icon"=>"icon-bar-chart", "sub"=>[
        ["link"=>"admin/report/ticket", "name"=>"Tickets", "icon"=>""],
      ]],
      ["name"=>"Frontend", "icon"=>"icon-settings", "sub"=>[
        ["link"=>"admin/frontend/content", "name"=>"Content"],
        ["link"=>"admin/frontend/banner", "name"=>"Banners"],
        ["link"=>"admin/frontend/service", "name"=>"Services"],
        /*["link"=>"admin/project", "name"=>"Projects"],
        ["link"=>"admin/project", "name"=>"Blog"],*/
      ]],
      ["name"=>"Settings", "icon"=>"icon-settings", "sub"=>[
        ["link"=>"admin/membership", "name"=>"Memberships"],
        ["link"=>"admin/skill", "name"=>"Skills"],
        ["link"=>"admin/role", "name"=>"Roles"],
        ["link"=>"admin/access", "name"=>"Accesses"],
        ["link"=>"admin/payment-method", "name"=>"Payment Methods"],
        ["link"=>"admin/category-for-ticket", "name"=>"Categories for Ticket"],
        ["link"=>"admin/working-day-time", "name"=>"Working Day Times"],
        ["link"=>"admin/blocked-date", "name"=>"Blocked Dates"],
        ["link"=>"admin/blocked-date-time", "name"=>"Blocked Date Times"],
        ["link"=>"admin/setting", "name"=>"Settings"],
        ["link"=>"admin/system", "name"=>"System"],
      ]],
    ];
    return $menu;
  }

  private static function getStaffMenu() {
    $menu = [
      ["link"=>"admin/dashboard/staff", "name"=>"Dashboard", "icon"=>"icon-home"],
    ];
    return $menu;
  }

}