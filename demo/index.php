<?php

date_default_timezone_set("Asia/Shanghai");

require dirname(__FILE__)."/../config.php";
require dirname(__FILE__)."/../library/include.php";

try {
    $client = new ClientCredentials(APP_KEY, APP_SECRET, ACCESS_TOKEN_URL);
    $result = $client->get_access_token();
var_dump($result);die;
    $rpc_client = new RpcClient($result->access_token, APP_KEY, APP_SECRET, API_SERVER_URL);

    $shop = new ShopService($rpc_client);
    $info = $shop->get_shop(720030);
    assert($info->id == 720030);

} catch (Exception $ex) {
    print($ex);
}
