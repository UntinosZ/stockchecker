<?php 
namespace App\tests\helpers;

require __dir__.'/../phpunit.php';

use App\helpers\Request;

/**
* Test Helpers Request class
*/
class RequestTest extends \PHPUnit_Framework_TestCase
{
	
	public function testRequestStatusCodeSuccess()
	{
		$url = 'http://untinosz.com/cv/';
		$request = new Request($url);
		$result = $request->getDom()->html();

		$this->assertContains("Nopparid Mokpradab", $result);
	}

	public function testGetObjectByAttributeIdSuccess()
	{
		$url = 'http://untinosz.com/cv/';
		$request = new Request($url);
		$result = $request->getAttributeByID('#future-5years');

		$this->assertTrue($result);		
	}

	public function testGetObjectByAttributeIdFail()
	{
		$url = 'http://untinosz.com/cv/';
		$request = new Request($url);
		$result = $request->getAttributeByID('#errorrrloostest');

		$this->assertFalse($result);		
	}

	public function testGetAttributeByTagClassSuccess()
	{
		$url = 'http://untinosz.com/cv/';
		$request = new Request($url);
		$result = $request->getAttributeByTagClass('a.list-group-item');

		$this->assertTrue($result);
	}

	public function testGetAttributeByTagClassFail()
	{
		$url = 'http://untinosz.com/cv/';
		$request = new Request($url);
		$result = $request->getAttributeByTagClass('a.list-group-112');

		$this->assertFalse($result);
	}


}
 ?>