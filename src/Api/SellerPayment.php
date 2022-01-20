<?php

namespace Darty\Api;

use Darty\Core\Client;

class SellerPayment extends Client {

	/**
	* Operation getTransactionsLogs
	 * @param array $query
	*/
	public function getTransactionsLogs($query = [])
	{
		return $this->send("/api/sellerpayment/transactions_logs", [
		  'method' => 'GET',
		  'query'  => $query,
		]);
	}
}
