<?php

namespace Darty\Api;

use Darty\Core\Client;

class Shipments extends Client {

	/**
	* Operation createShipments
	 * @param array $body
	*/
	public function createShipments($body = [])
	{
		return $this->send("/api/shipments", [
		  'method' => 'POST',
		  'json'   => $body,
		]);
	}
	
	/**
	 * Operation validateShipments
	 * @param array $body
	 */
	public function validateShipments($body = [])
	{
		return $this->send("/api/shipments/ship", [
			'method' => 'PUT',
			'json'   => $body,
		]);
	}
}
