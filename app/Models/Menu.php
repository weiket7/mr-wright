<?php namespace App\Models;

use App\Models\Enums\Role;

class Menu {
  private static function getSuperAdminMenu() {
    $menu[] = ['url'=>'po/view', 'name'=>'View PO'];
    $menu[] = ['url'=>'user', 'name'=>'Users'];
    $menu[] = ['url'=>'stock', 'name'=>'Stocks'];
    $menu[] = ['url'=>'stock/export', 'name'=>'Export Stocks'];
    $menu[] = ['name'=>'Stock Take', 'sub'=>[
      ['url'=>'stocktake/download', 'name'=>'Download Stock Take'],
      ['url'=>'stocktake/upload', 'name'=>'Upload Stock Take'],
      ['url'=>'stocktake/approve', 'name'=>'Approve Stock Take'],
      ['url'=>'stocktake/view', 'name'=>'View Stock Take'],
      ['url'=>'stocktake/delete', 'name'=>'Delete Stock Take']
    ]];
    $menu[] = ['name'=>'Reports', 'sub'=>[
      ['url'=>'report/soa-by-supplier', 'name'=>'SOA by Supplier'],
      ['url'=>'report/closing-stock', 'name'=>'Closing Stock'],
    ]];
    $menu[] = ['url'=>'outlet', 'name'=>'Outlets'];
    $menu[] = ['url'=>'supplier', 'name'=>'Suppliers'];
    $menu[] = ['url'=>'uom', 'name'=>'UOMs'];
    $menu[] = ['url'=>'dept', 'name'=>'Depts'];
    $menu[] = ['url'=>'company', 'name'=>'Company'];
    $menu[] = ['url'=>'config', 'name'=>'Configs'];
    return $menu;
  }
  
  private static function getAdminMenu() {
    $menu[] = ['url'=>'po/view', 'name'=>'View PO'];
    $menu[] = ['url'=>'stock', 'name'=>'Stocks'];
    $menu[] = ['url'=>'stock/export', 'name'=>'Export Stocks'];
    $menu[] = ['name'=>'Stock Take', 'sub'=>[
      ['url'=>'stocktake/download', 'name'=>'Download Stock Take'],
      ['url'=>'stocktake/upload', 'name'=>'Upload Stock Take'],
      ['url'=>'stocktake/approve', 'name'=>'Approve Stock Take'],
      ['url'=>'stocktake/view', 'name'=>'View Stock Take'],
    ]];
    $menu[] = ['name'=>'Reports', 'sub'=>[
      ['url'=>'report/soa-by-supplier', 'name'=>'SOA by Supplier'],
      ['url'=>'report/closing-stock', 'name'=>'Closing Stock'],
    ]];
    $menu[] = ['url'=>'outlet', 'name'=>'Outlets'];
    $menu[] = ['url'=>'supplier', 'name'=>'Suppliers'];
    $menu[] = ['url'=>'uom', 'name'=>'UOMs'];
    return $menu;
  }
  
  private static function getFinanceMenu() {
    $menu[] = ['url'=>'po/adjust', 'name'=>'Adjust PO'];
    $menu[] = ['url'=>'po/void', 'name'=>'Void PO'];
    $menu[] = ['url'=>'soa/finance/manage', 'name'=>'Manage SOA'];
    $menu[] = ['url'=>'po/view', 'name'=>'View PO'];
    $menu[] = ['name'=>'Stock Take', 'sub'=>[
      ['url'=>'stocktake/download', 'name'=>'Download Stock Take'],
      ['url'=>'stocktake/upload', 'name'=>'Upload Stock Take'],
      ['url'=>'stocktake/approve', 'name'=>'Approve Stock Take'],
      ['url'=>'stocktake/view', 'name'=>'View Stock Take'],
    ]];
    $menu[] = ['name'=>'Reports', 'sub'=>[
      ['url'=>'report/soa-by-supplier', 'name'=>'SOA by Supplier'],
      ['url'=>'report/closing-stock', 'name'=>'Closing Stock'],
    ]];
    return $menu;
  }
  
  private static function getSupplierMenu() {
    $menu[] = ['url'=>'soa/supplier/manage', 'name'=>'Manage SOA'];
    $menu[] = ['url'=>'po/view', 'name'=>'View PO'];
    return $menu;
  }
  
  private static function getStaffMenu() {
    $menu[] = ['url'=>'po/create', 'name'=>'Create PO'];
    $menu[] = ['url'=>'po/view', 'name'=>'View PO'];
    $menu[] = ['url'=>'po/accept', 'name'=>'Accept Delivery'];
    $menu[] = ['url'=>'po/cancel', 'name'=>'Cancel PO'];
    $menu[] = ['name'=>'Stock Take', 'sub'=>[
      ['url'=>'stocktake/download', 'name'=>'Download Stock Take'],
      ['url'=>'stocktake/upload', 'name'=>'Upload Stock Take'],
    ]];
    return $menu;
  }
  
  public static function getMenu($role_id) {
    if ($role_id == Role::SuperAdmin) {
      return self::getSuperAdminMenu();
    } else if ($role_id == Role::Admin) {
      return self::getAdminMenu();
    } else if ($role_id == Role::Finance) {
      return self::getFinanceMenu();
    } else if ($role_id == Role::Supplier) {
      return self::getSupplierMenu();
    } else if ($role_id == Role::Staff) {
      return self::getStaffMenu();
    }
    return [];
  }
}