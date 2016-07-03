<?php 
namespace App\tests\modules\bananastore;

require __dir__.'/../../phpunit.php';

use App\modules\bananastore\Checker;

/**
* Test Helpers Request class
*/
class RequestTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function testUrlExistsSuccess()
	{
		$url = 'http://shoponline.bananastore.com/product-detail/?productid=72754';
		$checker = new Checker($url);
		$result = $checker->getDom()->html();

		$this->assertContains("Apple iPad Mini 4 Wi-Fi 64GB Gold", $result);
	}

	public function testUrlExistsFail()
	{
		$url = 'http://shoponline.bananastore.com/product-detail/?productid=14123124';
		$checker = new Checker($url);
		$result = $checker->getDom()->html();

		$this->assertContains("ไม่พบสินค้า", $result);
	}

	public function testInStockSuccess()
	{
		//Check button id = AddToCart
		$url = 'http://shoponline.bananastore.com/product-detail/?productid=72754';
		$checker = new Checker($url);
		$result = $checker->getInStock();

		$this->assertTrue($result);
	}

	public function testOutOfStockSuccess()
	{
		//Check button id = AddToCart
		$url = 'http://shoponline.bananastore.com/product-detail/?productid=73529';
		$checker = new Checker($url);
		$result = $checker->getInStock();

		$this->assertFalse($result);
	}

	public function testGetPrice()
	{
		$url = 'http://shoponline.bananastore.com/product-detail/?productid=72754';
		$checker = new Checker($url);
		$result = $checker->getPrice();

		$this->assertEquals(16900, $result);
	}


}
 ?>