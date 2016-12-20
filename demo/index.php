<?php

date_default_timezone_set("Asia/Shanghai");

require dirname(__FILE__)."/../config.php";
require dirname(__FILE__)."/../library/include.php";

$shopId = 2252319;//沙箱
$categoryId = 501424332;

try {

    /**
     * @var ShopService $shop
     */

    $client = new ClientCredentials(APP_KEY, APP_SECRET, ACCESS_TOKEN_URL);
    $result = $client->get_access_token();
    //var_dump($result);die;
    $rpc_client = new RpcClient($result->access_token, APP_KEY, APP_SECRET, API_SERVER_URL);
    $shop = new ShopService($rpc_client);
    //$info = $shop->get_shop($shopId);
    //assert($info->id == $shopId);
    //var_dump($info);die;

    //$data = $shop->update_shop($shopId,['addressText' => $info->addressText . '-1']);//$data = $shop->createCategory($shopId, ['shopId' => $shopId, 'name' => '饮料', 'description' => '饮料描述']);
    //var_dump($data);
    //die;

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
        "name":"牛排--凉菜2",
        "description":"美味的食物-凉菜2",
        "imageHash":"3077080f760e7bf0fc985e23dd3e36e2",
        "labels":{"isFeatured":0,"isGum":0,"isNew":1,"isSpicy":1},
        "categoryId":"501425139",
        "specs":[
            {"maxStock":100,"name":"大份","onShelf":1,"packingFee":1.0,"price":19.9,"specId":0,"stock":0},
            {"maxStock":100,"name":"中分","onShelf":1,"packingFee":1.0,"price":19.9,"specId":0,"stock":0}
        ]
    }',true);

    unset($ps2['categoryId']);

    //print_r($ps2);
    //die;

    //echo json_encode($ps);
    //die;

    //$result  = $shop->createItem($categoryId,$ps2);
    //var_dump($result);die;

    $data = $shop->getShopCategories($shopId);
    //var_dump($data);

    $itemId = 510256481;
    $result  = $shop->getItem($itemId);
    var_dump($result);

    $result  = $shop->getItemsByCategoryId($categoryId);
    var_dump($result);





} catch (Exception $ex) {
    print($ex);
}
