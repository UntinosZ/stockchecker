<?php 
namespace App\tests;

require __dir__.'/phpunit.php';
require_once __dir__.'/../start.php';

use App\StockChecker;
/**
* Test Helpers Request class
*/
class StartTest extends \PHPUnit_Framework_TestCase
{
	public function testLoadItems()
	{
		$stock = new StockChecker;
		$result = $stock->loadItems();
		$this->assertCount(23, $result);
	}

}
 ?>