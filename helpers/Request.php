<?php 
namespace App\helpers;

use Goutte\Client;

/**
* Helpers request 
*/
class Request
{
	private $url;
	private $dom;

	function __construct($url)
	{
		$this->setUrl($url);
		$this->getHtml();
	}

	public function setUrl($url='')
	{
		$this->url = $url;
	}

	public function getUrl()
	{
		return $this->url;
	}
	public function setDom($dom)
	{
		$this->dom = $dom;
	}
	public function getDom()
	{
		return $this->dom;
	}

	public function getHtml()
	{
		$client = new Client();
		$crawler = $client->request('GET', $this->url);
		$this->setDom($crawler);
	}


	public function getAttributeById($id)
	{
		$result = $this->dom->filter($id);

		return $result->count() > 0 ? true : false;
	}

	public function getAttributeByTagClass($tagClass='')
	{
		$result = $this->dom->filter($tagClass);

		return $result->count() > 0 ? true : false;
	}

	
}
 ?>