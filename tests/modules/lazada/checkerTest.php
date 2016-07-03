<?php 
namespace App\tests\modules\lazada;

require __dir__.'/../../phpunit.php';

use App\modules\lazada\Checker;

/**
* Test Helpers Request class
*/
class RequestTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function testUrlExistsSuccess()
	{
		$url = 'http://www.lazada.co.th/monitor-acer-predator-led-28-xb281hkbmiprz28h-6617091.html';
		$checker = new Checker($url);
		$result = $checker->getDom()->html();

		$this->assertContains("Monitor Acer Predator", $result);
	}

	public function testUrlExistsFail()
	{
		$url = 'http://www.lazada.co.th/asdfad/';
		$checker = new Checker($url);
		$result = $checker->getDom()->html();

		$this->assertContains("404 Error", $result);
	}

	public function testInStockSuccess()
	{
		//Check button id = AddToCart
		$url = 'http://www.lazada.co.th/monitor-acer-predator-led-28-xb281hkbmiprz28h-6617091.html';
		$checker = new Checker($url);
		$result = $checker->getInStock();

		$this->assertTrue($result);
	}

	public function testOutOfStockSuccess()
	{
		//Check button id = AddToCart
		$url = 'http://www.lazada.co.th/nillkin-lenovo-p90-k80-9h-2290419.html';
		$checker = new Checker($url);
		$result = $checker->getInStock();

		$this->assertFalse($result);
	}

	public function testGetPrice()
	{
		//Check button id = AddToCart
		$url = 'http://www.lazada.co.th/monitor-acer-predator-led-28-xb281hkbmiprz28h-6617091.html';
		$currentPrice = 22800;
		$checker = new Checker($url);
		$result = $checker->getPrice();

		$this->assertEquals($result, $currentPrice);
	}

}
 ?>