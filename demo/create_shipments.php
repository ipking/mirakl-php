<?php



include '.config.php';

$api = new \Mirakl\Api\Shipments();
$api->setApiKey($options['api_key']);
$api->setShopId($options['shop_id']);
$api->setEndpoint($options['endpoint']);

$data = [
	'order_id'  => "ORDER_01-A",
	"tracking"=> [
		"carrier_code"=> "UPS",
        "carrier_name"=> "UPS",
        "tracking_number"=> "1Z2356F1ZJ98L9733M5",
        "tracking_url"=> "https=>//wwwapps.ups.com/WebTracking/track?track=yes&trackNums={trackingId}"
	],
	"shipment_lines"=> [
		[
	        "offer_sku"=> "OFFER_SKU_1",
	        "quantity"=> 1
		],
		[
	        "offer_sku"=> "OFFER_SKU_2",
	        "quantity"=> 3
		]
	],
	"shipped"=> false
];
$body = [];
$body['shipments'][] = $data;

$rsp = $api->createShipments($body);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);



$data = [
	'id'  => "f40bf65e-a320-41d3-878c-36ce9e1144ce",
];
$body = [];
$body['shipments'][] = $data;

$rsp = $api->validateShipments($body);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);

