<?php



include '.config.php';

$api = new \Darty\Api\Orders();
$api->setApiKey($options['api_key']);
$api->setShopId($options['shop_id']);
$api->setEndpoint($options['endpoint']);

$offset = 0;
$max = 20;
while(1){
	$data = [
		'start_update_date'  => "2021-12-11T09:00:00",
		'end_update_date' => "2022-01-01T09:00:00",
		'offset' => $offset,
		'max' => $max,
	];
	
	$rsp = $api->getOrders($data);
	if(!$api->isSuccess()){
		print_r($rsp);
		die();
	}
	print_r($rsp);
	if(!$rsp['orders']){
		break;
	}
	$offset += $max;
	
	if($offset > $rsp['total_count']){
		break;
	}
}



$data = [
	'order_ids'  => "ORDER_01-A,ORDER_02-A"
];

$rsp = $api->getOrders($data);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);

