<?php 
namespace App\tests\modules\itcityonline;

require __dir__.'/../../phpunit.php';
use App\modules\itcityonline\Checker;

/**
* Test Helpers Request class
*/
class RequestTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function testGetIdFromUrl()
	{
		$data = array(
			array(
		        "name" => "Predator G3-710-648G1T00MGI",
		        "url" => "http://www.itcityonline.com/item/201602DM040000089",
		        "price" => 41900,
		    ),
		    array(
		        "name" => "Predator G6-710-6716G2T00MGi/T001",
		        "url" => "http://www.itcityonline.com/item/201602DM040000090",
		        "price" => 85900,
		    ),
		    array(
		        "name" => "Predator G9-591-722R",
		        "url" => "http://www.itcityonline.com/item/201605DM110000016",
		        "price" => 69900,
		    ),
		    array(
		        "name" => "Predator G9-791-72Q4",
		        "url" => "http://www.itcityonline.com/item/201512DM240000163/D5521",
		        "price" => 89900,
		    ),
		    array(
		        "name" => "Predator Z35",
		        "url" => "http://www.itcityonline.com/item/201604DM040000047",
		        "price" => 34900,
		    )
       	);
       	$checker = new Checker($data);
       	$result = $checker->getIds();

       	$this->assertEquals(count($result), 5);
	}

	public function testGetDataFromAPI()
	{
		$data = array(
			array(
		        "name" => "Predator G3-710-648G1T00MGI",
		        "url" => "http://www.itcityonline.com/item/201602DM040000089",
		        "price" => 41900,
		    ),
		    array(
		        "name" => "Predator G6-710-6716G2T00MGi/T001",
		        "url" => "http://www.itcityonline.com/item/201602DM040000090",
		        "price" => 85900,
		    ),
		    array(
		        "name" => "Predator G9-591-722R",
		        "url" => "http://www.itcityonline.com/item/201605DM110000016",
		        "price" => 69900,
		    ),
		    array(
		        "name" => "Predator G9-791-72Q4",
		        "url" => "http://www.itcityonline.com/item/201512DM240000163/D5521",
		        "price" => 89900,
		    ),
		    array(
		        "name" => "Predator Z35",
		        "url" => "http://www.itcityonline.com/item/201604DM040000047",
		        "price" => 34900,
		    )
       	);
       	$checker = new Checker($data);
       	$result = $checker->getAPIData();

       	$this->assertEquals(count($result['data']), 5);
	}


	// public function testUrlExistsSuccess()
	// {
	// 	$url = 'http://www.itcityonline.com/item/201602DM040000089';
	// 	$checker = new Checker($url);
	// 	$result = $checker->getDom()->html();

	// 	$this->assertContains("ACER Predator G3-710-648G1T00MGi/T001", $result);
	// }

	// public function testUrlExistsFail()
	// {
	// 	$url = 'http://www.itcityonline.com/item/201602DM01412311';
	// 	$checker = new Checker($url);
	// 	$result = $checker->getDom()->html();

	// 	$this->assertContains("Sorry, the page has been removed.", $result);
	// }

	// public function testInStockSuccess()
	// {
	// 	//Check button id = AddToCart
	// 	$url = 'http://www.itcityonline.com/item/201602DM040000089';
	// 	$checker = new Checker($url);
	// 	$result = $checker->getInStock();

	// 	$this->assertTrue($result);
	// }

	// public function testOutOfStockSuccess()
	// {
	// 	//Check button id = AddToCart
	// 	$url = 'http://www.itcityonline.com/item/201603DM300000016/D5587';
	// 	$checker = new Checker($url);
	// 	$result = $checker->getInStock();

	// 	$this->assertFalse($result);
	// }


}
 ?>