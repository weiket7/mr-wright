<?php

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


  public static function formatDate($date, $birthday = false) {
    if ($date == '') {
      return '';
    }
    if ($birthday) {
      return date('d-m-Y', strtotime($date));
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

  public static function formatDateDay($date) {
    return date('d M Y, l', strtotime($date));
  }

  public static function formatNumber($number) {
    if (abs($number - round($number)) < 0.0001) { //whole number
      return round($number);
    } 
    return number_format(round($number, 2), 2);
  }

}
