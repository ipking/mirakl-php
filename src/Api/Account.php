<?php

namespace Darty\Api;

use Darty\Core\Client;

class Account extends Client {

	/**
	* Operation getShopInformation
	*/
	public function getShopInformation()
	{
		return $this->send("/api/account", [
		  'method' => 'GET',
		]);
	}
}
