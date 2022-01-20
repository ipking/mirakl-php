<?php



include '.config.php';


$api = new \Darty\Api\SellerPayment();
$api->setApiKey($options['api_key']);
$api->setShopId($options['shop_id']);

$page_token = '';
while(1){
	$data = [
		'order_id'  => "ORDER_01-A",
	];
	if($page_token){
		$data['page_token'] = $page_token;
	}
	
	$rsp = $api->getTransactionsLogs($data);
	if(!$api->isSuccess()){
		print_r($rsp);
		die();
	}
	print_r($rsp);
	if(!$rsp['next_page_token']){
		break;
	}
	
	$page_token = $rsp['next_page_token'];
	
}


$page_token = '';
while(1){
	$data = [
		'last_updated_from'  => "2021-12-21T01:12:14.806Z",
	];
	if($page_token){
		$data['page_token'] = $page_token;
	}
	
	$rsp = $api->getTransactionsLogs($data);
	if(!$api->isSuccess()){
		print_r($rsp);
		die();
	}
	print_r($rsp);
	if(!$rsp['next_page_token']){
		break;
	}
	
	$page_token = $rsp['next_page_token'];
	
}
