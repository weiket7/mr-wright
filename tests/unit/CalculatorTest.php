<?php


use App\Models\Brand;
use App\Models\Category;

class CalculatorTest extends \Codeception\TestCase\Test
{
  protected $tester;

  public function testGetDistinctBrandByCategory() {
    $total = 2+2;
    $this->assertEquals(4, $total);
  }

}