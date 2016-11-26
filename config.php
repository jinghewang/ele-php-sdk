<?php

$sandbox = true;
$app_key = ""; // your app_key
$secret = ""; // your secret





// don't change here
define("SANDBOX", $sandbox);
define("APP_KEY", $app_key);
define("APP_SECRET", $secret);
define("REQUEST_DOMAIN", $sandbox ? "open-api-sandbox.shop.ele.me" : "open-api.shop.ele.me");
define("ACCESS_TOKEN_URL", "https://" . REQUEST_DOMAIN . "/token");
define("API_SERVER_URL", "https://" . REQUEST_DOMAIN . "/api/v1/");

