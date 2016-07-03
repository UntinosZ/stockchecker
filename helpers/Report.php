<?php 
namespace App\helpers;

/**
* Report 
*/
class Report
{
	private $data;
	private $defaultReportPath = __dir__.'/../report';

	function __construct($data)
	{
		$this->setData($data);
		$this->findOrCreateDir();
	}

	public function setData($data='')
	{
		$this->data = $data;
	}

	public function getData()
	{
		return $this->data;
	}

	public function findOrCreateDir()
	{
		if (!file_exists($this->defaultReportPath)) {
		    mkdir($this->defaultReportPath, 0777, true);
		}
	}

	public function exportJSON($fileName='')
	{
		try {
			$file = fopen($this->defaultReportPath."/".$fileName, "w") or die("Unable to open file!");
			$report = json_encode($this->data, true);
			fwrite($file, $report);
			fclose($file);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	
}
 ?>