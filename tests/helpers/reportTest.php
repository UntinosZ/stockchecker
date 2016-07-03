<?php 
namespace App\tests\helpers;

require __dir__.'/../phpunit.php';

use App\helpers\Report;

/**
* Test Helpers Report class
*/
class ReportTest extends \PHPUnit_Framework_TestCase
{
	
	public function testExportReportToJSON()
	{
		$data = array(
			"vendor" => "JIB",
			"data" => array(
				array(
		            "name" => "Predator G3-710-648G1T00MGI",
		            "url" => "https://www.jib.co.th/web/index.php/product/readProduct/20472/2/DESKTOP-PC-ACER-PREDATOR-G3-710-648G1T00MGI",
		            "price" => 41900,
		            "reason" => "Price Change",
		            "currentPrice" => 40900
		        ),
		        array(
		            "name" => "Predator G9-591-722R",
		            "url" => "https://www.jib.co.th/web/index.php/product/readProduct/20742/2/NOTEBOOK-ACER-PREDATOR-G9-591-722R-T001",
		            "price" => 69900,
		            "reason" => "Out of Stock"
		        ),
		        array(
		            "name" => "Aspire VN7-572G-734L",
		            "url" => "https://www.jib.co.th/web/index.php/product/readProduct/21165/2/NOTEBOOK-ACER-ASPIRE-VN7-572G-734L-T001",
		            "price" => 37900,
		            "reason" => "Price Change",
		            "currentPrice" => 36900
		        ),
		        array(
		            "name" => "Aspire VN7-792G-749Y",
		            "url" => "https://www.jib.co.th/web/index.php/product/readProduct/19561/2/NOTEBOOK-ACER-ASPIRE-VN7-792G-749Y-T001",
		            "price" => 45900,
		            "reason" => "Price Change",
		            "currentPrice" => 43900
		        )
	        )
       	);
       	$filename = 'jib.json';
		$report = new Report($data);
		$result = $report->exportJSON($filename);

		$this->assertTrue($result);
	}
}
 ?>
 ?>