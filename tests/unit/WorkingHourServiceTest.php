<?php


use App\Models\Brand;
use App\Models\Category;
use App\Models\Services\WorkingHourService;

class WorkingHourServiceTest extends \Codeception\TestCase\Test
{
  protected $tester;

  public function testGetAvailableWorkingHours() {
    $working_hour_service = new WorkingHourService();
    $hours = $working_hour_service->getWorkingIntervalsByDate();
    $this->assertEquals(6, count($hours));
  }

  public function testSplitTimeRangeIntoInterval() {
    $working_hour_service = new WorkingHourService();
    $res = $working_hour_service->splitTimeRangeIntoInterval('07:00:00', '09:00:00', 15);
    $expected = ['07:00', '07:15', '07:30', '07:45', '08:00', '08:15', '08:30', '08:45'];
    sort($expected);
    sort($res);
    $this->assertEquals($expected, $res);
  }

  public function testAssertArray() {
    $res = [1,2,3];
    $expected = [3,2,1];
    sort($res);
    sort($expected);
    $this->assertEquals($expected, $res);
  }

  public function testAssertArray2() {
    $res = ['11:00','11:30','12:00'];
    $expected = ['12:00','11:30','11:00'];
    sort($res);
    sort($expected);
    $this->assertEquals($expected, $res);
  }

}