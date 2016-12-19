<?php

$sandbox = true;
$app_key = "FfGGsXF8gk"; // your app_key
$secret = "5d2ad49dd428f3585cd9db9e2ae1b98b"; // your secret





// don't change here
define("SANDBOX", $sandbox);
define("APP_KEY", $app_key);
define("APP_SECRET", $secret);
define("REQUEST_DOMAIN", $sandbox ? "open-api-sandbox.shop.ele.me" : "open-api.shop.ele.me");
define("ACCESS_TOKEN_URL", "https://" . REQUEST_DOMAIN . "/token");
define("API_SERVER_URL", "https://" . REQUEST_DOMAIN . "/api/v1/");

