<?php 
namespace App\tests\modules\jib;

require __dir__.'/../../phpunit.php';

use App\modules\jib\Controller;

/**
* Test JIB Controller class
*/
class ControllerTest extends \PHPUnit_Framework_TestCase
{
	/** @test */
	public function testGetJSONFromFile()
	{
		$filePath = __dir__.'/items.json';
		$controller = new Controller();
		$result = $controller->getDataFromJSON($filePath);
		$this->assertEquals(2, count($result));
	}

}
 ?>