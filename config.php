<?php

$sandbox = true;
$app_key = "4XBF5XBbWx"; // your app_key 沙箱
$secret = "83b3b6d0e19ed60471a8e62d5d4c5d67"; // your secret  沙箱
$shopId = 2282357;//沙箱
$appId = 84484465;


// don't change here
define("SANDBOX", $sandbox);
define("APP_KEY", $app_key);
define("APP_SECRET", $secret);
define("REQUEST_DOMAIN", $sandbox ? "open-api-sandbox.shop.ele.me" : "open-api.shop.ele.me");
define("ACCESS_TOKEN_URL", "https://" . REQUEST_DOMAIN . "/token");
define("API_SERVER_URL", "https://" . REQUEST_DOMAIN . "/api/v1/");

