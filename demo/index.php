<?php

date_default_timezone_set("Asia/Shanghai");

require dirname(__FILE__)."/../config.php";
require dirname(__FILE__)."/../library/include.php";
require dirname(__FILE__)."/function.php";


//$shopId = 2252015;//2252319;//沙箱
$categoryId = 501424332;




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
    //print_r2($info);die;

    $data = $shop->update_shop($shopId, ['openTime' => '10:00-15:55,16:00-21:00', 'isValid' => 1, 'addressText' => '上海市普陀区金沙江路近铁城市广场']);//$data = $shop->createCategory($shopId, ['shopId' => $shopId, 'name' => '饮料', 'description' => '饮料描述']);
    //print_r2($data);die;

    $ps = [
        //'id'=>112212132,
        'name'=>'黄金炒饭',
        'isValid' => false,
        'recentPopularity'=>10,
        'categoryId' => $categoryId,
        'shopId' => $shopId,
        'shopName' => '',
        'imageUrl' => 'http://pic.ele.me/1929345.png',
        //'labels' => '{"isFeatured":0,"isGum":0,"isNew":1,"isSpicy":1}',
        //'specs' => '[{"maxStock":100,"name":"大份","onShelf":1,"packingFee":1.0,"price":19.9,"specId":0,"stock":0},{"maxStock":100,"name":"中分","onShelf":1,"packingFee":1.0,"price":19.9,"specId":0,"stock":0}]',
        "description" => "黄金炒饭"
    ];

    $ps2 = json_decode('{
        "name":"牛排--特惠2",
        "description":"美味的食物-凉菜2",
        "imageHash":"3077080f760e7bf0fc985e23dd3e36e2",
        "labels":{"isFeatured":0,"isGum":0,"isNew":1,"isSpicy":1},
        "categoryId":"501425139",
        "specs":[
            {"maxStock":10000,"name":"大份","onShelf":1,"packingFee":0.0,"price":0.02,"specId":0,"stock":100},
            {"maxStock":10000,"name":"中分","onShelf":1,"packingFee":0.0,"price":0.01,"specId":0,"stock":100}
        ]
    }',true);

    unset($ps2['categoryId']);

    //print_r2($ps2);
    //die;

    //echo json_encode($ps);
    //die;

    //$result  = $shop->createItem($categoryId,$ps2);
    //var_dump($result);die;

    $appId = 79386795;
    $data = $shop->getNonReachedMessages($appId);
    //print_r2($data);

    $data = $shop->getShopCategories($shopId);
    //print_r2($data);

    $result  = $shop->getItemsByCategoryId($categoryId);
    //print_r2($result);

    $itemId = 510256481;
    $result  = $shop->getItem($itemId);
    //var_dump($result);

    $orderId = '101805421022941086';
    $result = $shop->getOrder($orderId);
    print_r2($result);

    $result = $shop->confirmOrder($orderId);
    print_r2($result);

} catch (Exception $ex) {
    print($ex);
}
