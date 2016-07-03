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
		$checker = new Checker();
		$result = $checker->getDom($url)->html();

		$this->assertContains("Apple iPad Mini 4 Wi-Fi 64GB Gold", $result);
	}

	public function testUrlExistsFail()
	{
		$url = 'http://shoponline.bananastore.com/product-detail/?productid=14123124';
		$checker = new Checker();
		$result = $checker->getDom($url)->html();

		$this->assertContains("ไม่พบสินค้า", $result);
	}

	public function testInStockSuccess()
	{
		//Check button id = AddToCart
		$url = 'http://shoponline.bananastore.com/product-detail/?productid=72754';
		$checker = new Checker();
		$result = $checker->getInStock($url);

		$this->assertTrue($result);
	}

	public function testOutOfStockSuccess()
	{
		//Check button id = AddToCart
		$url = 'http://shoponline.bananastore.com/product-detail/?productid=73529';
		$checker = new Checker();
		$result = $checker->getOutOfStock($url);

		$this->assertTrue($result);
	}


}
 ?>