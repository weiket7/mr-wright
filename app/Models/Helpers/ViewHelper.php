<?php

use App\Models\Enums\TicketStat;
use App\Models\Helpers\BackendHelper;
use Carbon\Carbon;

class ViewHelper {
  public static function formatDateTime($date) {
    return date('d M Y, h:i a', strtotime($date));
  }

  public static function getNowSql() {
    return date('Y-m-d H:i:s');
  }
  public static function getNowFormatted() {
    return date('d M Y, h:i a');
  }

  public static function hasAccess($access) {
    return in_array($access, session()->get('accesses')['accesses']);
  }

  public static function formatDate($date) {
    if ($date == '') {
      return '';
    }
    return date('d M Y', strtotime($date));
  }

  public static function formatTime($time)
  {
    if ($time == '') {
      return '';
    }
    return date('g:i a', strtotime($time));
  }
  
  public static function formatTimeValue($time)
  {
    if ($time == '') {
      return '';
    }
    return date('H:i', strtotime($time));
  }

  public static function formatDateDay($date) {
    return date('d M Y, l', strtotime($date));
  }

  public static function timeAgo($date) {
    $now = Carbon::now();
    $date = Carbon::createFromFormat('Y-m-d H:i:s', $date);
    $minutes = $now->diffInMinutes($date);
    if ($minutes <= 1) {
      return "Just now";
    }
    if ($minutes < 60) {
      return $minutes . ' mins';
    }
    if ($minutes < 720) {
      return floor($minutes / 60) . ' hours';
    }
    return $now->diffInDays($date) . ' days';
  }

  public static function formatNumber($number) {
    if ($number == null || $number == '') {
       return '';
    }
    if (abs($number - round($number)) < 0.0001) { //whole number
      return round($number);
    } 
    return number_format(round($number, 2), 2);
  }

  public static function formatCurrency($number) {
    return '$'.$number;
  }
  
  public static function frontendShowStaffAssignments($ticket_stat) {
    return ! in_array($ticket_stat, [TicketStat::Drafted, TicketStat::Opened, TicketStat::Declined]);
  }
  
  public static function frontendShowOtps($ticket_stat) {
    return ! in_array($ticket_stat, [TicketStat::Drafted, TicketStat::Opened, TicketStat::Quoted, TicketStat::Declined]);
  }
  
  public static function isImage($file_name) {
    $file_name = strtolower($file_name);
    $extension = explode('.', $file_name)[1];
    $image_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    return in_array($extension, $image_extensions);
  }
}
