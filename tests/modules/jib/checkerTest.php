<?php 
namespace App\tests\modules\jib;

require __dir__.'/../../phpunit.php';

use App\modules\jib\Checker;

/**
* Test Helpers Request class
*/
class RequestTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function testUrlExistsSuccess()
	{
		$url = 'https://www.jib.co.th/web/index.php/product/readProduct/20472/2/DESKTOP-PC-ACER-PREDATOR-G3-710-648G1T00MGI';
		$checker = new Checker($url);
		$result = $checker->getDom()->html();

		$this->assertContains("DESKTOP PC ACER PREDATOR G3-710-648G1T00MGI", $result);
	}

	public function testUrlExistsFail()
	{
		$url = 'http://www.jib.co.th/asdfad/';
		$checker = new Checker($url);
		$result = $checker->getDom()->html();

		$this->assertContains("404 Not Found", $result);
	}

	public function testInStockSuccess()
	{
		//Check button id = AddToCart
		$url = 'https://www.jib.co.th/web/index.php/product/readProduct/20472/2/DESKTOP-PC-ACER-PREDATOR-G3-710-648G1T00MGI';
		$checker = new Checker($url);
		$result = $checker->getInStock();

		$this->assertTrue($result);
	}

	public function testOutOfStockSuccess()
	{
		//Check button id = AddToCart
		$url = 'https://www.jib.co.th/web/index.php/product/readProduct/51234/43/TABLET-APPlE-IPAD-MINI-WITH-RETINA-WIFI---4G-GRAY';
		$checker = new Checker($url);
		$result = $checker->getInStock();

		$this->assertFalse($result);
	}

	public function testGetPriceOfProduct()
	{
		//Check button id = AddToCart
		$url = 'https://www.jib.co.th/web/index.php/product/readProduct/20472/2/DESKTOP-PC-ACER-PREDATOR-G3-710-648G1T00MGI';
		$currentPrice = 40900;
		$checker = new Checker($url);
		$result = $checker->getPrice();

		$this->assertEquals($result, $currentPrice);
	}

}
 ?>