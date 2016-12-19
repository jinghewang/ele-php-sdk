<?php

date_default_timezone_set("Asia/Shanghai");

require dirname(__FILE__)."/../config.php";
require dirname(__FILE__)."/../library/include.php";

$shopId = 2252319;
$categoryId = 501424332;

try {
    $client = new ClientCredentials(APP_KEY, APP_SECRET, ACCESS_TOKEN_URL);
    $result = $client->get_access_token();
    //var_dump($result);die;

    $rpc_client = new RpcClient($result->access_token, APP_KEY, APP_SECRET, API_SERVER_URL);

    $shop = new ShopService($rpc_client);
    //$info = $shop->get_shop($shopId);
    //assert($info->id == $shopId);


    //$result = $shop->update_shop($shopId,['addressText' => $info->addressText . '-1']);//$data = $shop->createCategory($shopId, ['shopId' => $shopId, 'name' => '饮料', 'description' => '饮料描述']);
    //var_dump($data);

    $ps = [
        'id'=>112212132,
        'name'=>'黄金炒饭',
        'isValid' => false,
        'recentPopularity'=>10,
        'categoryId' => $categoryId,
        'shopId' => $shopId,
        'shopName' => '',
        'imageUrl' => 'http://pic.ele.me/1929345.png',
        'labels' => '{"isFeatured":0,"isGum":0,"isNew":1,"isSpicy":1}',
        'specs' => '[{"maxStock":100,"name":"大份","onShelf":1,"packingFee":1.0,"price":19.9,"specId":0,"stock":0},{"maxStock":100,"name":"中分","onShelf":1,"packingFee":1.0,"price":19.9,"specId":0,"stock":0}]',//json_encode(['specId'=>11322321,'name'=>'11','price'=>18.1,'stock'=>100,'maxStock'=>1000,'packingFee'=>3.0,'onShelf'=>1]),
        "description" => "黄金炒饭"
    ];

    //echo json_encode($ps);
    //die;

    $result  = $shop->createItem($categoryId,$ps);

    var_dump($result);


    //$data = $shop->getShopCategories($shopId);
    //var_dump($data);

} catch (Exception $ex) {
    print($ex);
}
