<?php

date_default_timezone_set("Asia/Shanghai");

require dirname(__FILE__) . "/../config.php";
require dirname(__FILE__) . "/../library/include.php";
require dirname(__FILE__) . "/function.php";


$categoryId = 502379413;


try {

    /**
     * @var ShopService $shop
     */

    $client = new ClientCredentials(APP_KEY, APP_SECRET, ACCESS_TOKEN_URL);
    $result = $client->get_access_token();
    print_r2($result);
    $rpc_client = new RpcClient($result->access_token, APP_KEY, APP_SECRET, API_SERVER_URL);
    $shop = new ShopService($rpc_client);
    $info = $shop->get_shop($shopId);
    //assert($info->id == $shopId);
    //print_r2($info);
    //die;

    //$data = $shop->update_shop($shopId, [//'openTime'        => '10:00-15:55,16:00-21:00',
                                      //   'isValid'         => 1,
                                         //'addressText'     => '上海市普陀区金沙江路近铁城市广场',
                                         //'serviceCategory' => 1,
                                         //'deliverGeoJson'  => '{"zeroDeliveryRule": {"merchantSubsidy": 0.0, "distanceFee": {"distanceUnitFee": 1.0, "distanceBasic": 2000, "distanceUnit": 500}, "deliveryFee": {"deliveryFeeItems": [0.0, 0.0, 0.0], "priceItems": [0, 20, 100]}, "specialTimeFee": [{"fee": 3.0, "startTime": "22:00:00", "endTime": "23:59:59"}, {"fee": 3.0, "startTime": "00:00:01", "endTime": "7:00:00"}]}, "currentDeliveryRule": "zeroDeliveryRule", "type": "FeatureCollection", "features": [{"geometry": {"type": "Polygon", "coordinates": [[[121.464575885, 31.018697], [121.45598144, 31.0364827352], [121.435226, 31.0330700445], [121.420401081, 31.0314010966], [121.405876115, 31.018697], [121.41151024, 30.9983704455], [121.435226, 31.0043239555], [121.447084512, 31.0085337227], [121.464575885, 31.018697]]]}, "type": "Feature", "id": "e74a291e-cb87-11e6-a37e-384c4fcb5a52", "properties": {"delivery_price": 20.0, "manual_weight": 0.0, "system_weight": 0, "weight_type": 1, "area_agent_fee": 5.0}}]}'
    //]);

    //print_r2($data);die;

    $ps = [
        //'id'=>112212132,
        'name'             => '黄金炒饭',
        'isValid'          => false,
        'recentPopularity' => 10,
        'categoryId'       => $categoryId,
        'shopId'           => $shopId,
        'shopName'         => '',
        'imageUrl'         => 'http://pic.ele.me/1929345.png',
        //'labels' => '{"isFeatured":0,"isGum":0,"isNew":1,"isSpicy":1}',
        //'specs' => '[{"maxStock":100,"name":"大份","onShelf":1,"packingFee":1.0,"price":19.9,"specId":0,"stock":0},{"maxStock":100,"name":"中分","onShelf":1,"packingFee":1.0,"price":19.9,"specId":0,"stock":0}]',
        "description"      => "黄金炒饭"
    ];

    $ps2 = json_decode("{
        \"name\":\"牛排--特惠5\",
        \"description\":\"美味的食物-凉菜2\",
        \"imageHash\":\"3077080f760e7bf0fc985e23dd3e36e2\",
        \"labels\":{\"isFeatured\":0,\"isGum\":0,\"isNew\":1,\"isSpicy\":1},
        \"categoryId\":\"{$categoryId}\",
        \"specs\":[
            {\"maxStock\":10000,\"name\":\"大份\",\"onShelf\":1,\"packingFee\":0.0,\"price\":0.02,\"specId\":0,\"stock\":100},
            {\"maxStock\":10000,\"name\":\"中分\",\"onShelf\":1,\"packingFee\":0.0,\"price\":0.01,\"specId\":0,\"stock\":100}
        ]
    }", true);

    //unset($ps2['categoryId']);


    //$result  = $shop->createItem($categoryId,$ps2);
    //var_dump($result);die;


    $data = $shop->getNonReachedMessages($appId);
    //print_r2($data);

    $data = $shop->getShopCategories($shopId);
    print_r2($data);

    $result = $shop->getItemsByCategoryId($categoryId);
    //print_r2($result);

    $itemId = 515998824;
    $result = $shop->getItem($itemId);
    //var_dump($result);

    $orderId = '101840099268858523';
    $result = $shop->getOrder($orderId);
    print_r2($result);die;

    $result = $shop->confirmOrder($orderId);
    print_r2($result);

} catch (Exception $ex) {
    print($ex);
}
