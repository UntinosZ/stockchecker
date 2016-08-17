<?php 
namespace App\tests\modules\advice;

require __dir__.'/../../phpunit.php';

use App\modules\advice\Checker;

/**
* Test Helpers Request class
*/
class RequestTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function testUrlExistsSuccess()
	{
		$url = 'https://online.advice.co.th/product/notebook/notebook-asus/notebook-asus-e200ha-fd0008ts-dark-blue-';
		$checker = new Checker($url);
		$result = $checker->getDom()->html();

		$this->assertContains("Notebook Asus E200HA-FD0008TS", $result);
	}

	public function testUrlExistsFail()
	{
		$url = 'http://www.advice.co.th/asdfad/';
		$checker = new Checker($url);
		$result = $checker->getDom()->html();

		$this->assertContains("Whoops! There was an error.", $result);
	}

	public function testInStockSuccess()
	{
		//Check button id = AddToCart
		$url = 'https://online.advice.co.th/product/notebook/notebook-asus/notebook-asus-e200ha-fd0008ts-dark-blue-';
		$checker = new Checker($url);
		$result = $checker->getInStock();

		$this->assertTrue($result);
	}

	public function testOutOfStockSuccess()
	{
		//Check button id = AddToCart
		$url = 'https://www.advice.co.th/web/index.php/product/readProduct/51234/43/TABLET-APPlE-IPAD-MINI-WITH-RETINA-WIFI---4G-GRAY';
		$checker = new Checker($url);
		$result = $checker->getInStock();

		$this->assertFalse($result);
	}

	public function testGetPriceOfProduct()
	{
		//Check button id = AddToCart
		$url = 'https://online.advice.co.th/product/notebook/notebook-acer/notebook-acer-predator-g9-791-72q4-t001-black-/A0084816';
		$currentPrice = 85900;
		$checker = new Checker($url);
		$result = $checker->getPrice();

		$this->assertEquals($result, $currentPrice);
	}

}
 ?>