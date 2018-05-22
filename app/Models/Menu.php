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
      ["link"=>"admin/staff", "name"=>"Staff", "icon"=>"icon-wrench"],
      ["link"=>"admin/ticket", "name"=>"Tickets", "icon"=>"icon-note"],
      ["link"=>"admin/operator", "name"=>"Operators", "icon"=>"icon-eyeglasses"],
      ["name"=>"Frontend", "icon"=>"icon-settings", "sub"=>[
        ["link"=>"admin/frontend/content", "name"=>"Content"],
        ["link"=>"admin/frontend/banner", "name"=>"Banners"],
        ["link"=>"admin/frontend/service", "name"=>"Services"],
        ["link"=>"admin/frontend/dynamic", "name"=>"Dynamic"],
        ["link"=>"admin/frontend/blog", "name"=>"Blog"]
      ]],
      ["name"=>"Settings", "icon"=>"icon-settings", "sub"=>[
        ["link"=>"admin/membership", "name"=>"Memberships"],
        ["link"=>"admin/skill", "name"=>"Skills"],
        ["link"=>"admin/role", "name"=>"Roles"],
        ["link"=>"admin/payment-method", "name"=>"Payment Methods"],
        ["link"=>"admin/category-for-ticket", "name"=>"Categories for Ticket"],
        ["link"=>"admin/working-day-time", "name"=>"Working Day Times"],
        ["link"=>"admin/blocked-date", "name"=>"Blocked Dates"],
        ["link"=>"admin/blocked-date-time", "name"=>"Blocked Date Times"],
        ["link"=>"admin/setting", "name"=>"Settings"],
      ]],
    ];
    return $menu;
  }

  private static function getStaffMenu() {
    $menu = [
      ["link"=>"admin/staff/dashboard", "name"=>"Dashboard", "icon"=>"icon-home"],
    ];
    return $menu;
  }

}