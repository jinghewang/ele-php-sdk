<?php

try {
    require dirname(__FILE__)."/../config.php";
    require dirname(__FILE__)."/../library/include.php";

    $content = file_get_contents("php://input");
    if (is_null($content)) {
        throw new IllegalRequestException("invalid post data. post data is empty.");
    }

    $json = json_decode($content);
    if (is_null($json)
        || !isset($json->request_id)
        || !isset($json->type)
        || !isset($json->message)
        || !isset($json->shop_id)
        || !isset($json->timestamp)
        || !isset($json->signature)
    ) {
        throw new IllegalRequestException("illegal json. post data is " . $content);
    }

    $str = $json->type . $json->message . $json->request_id . $json->shop_id . $json->timestamp . APP_SECRET;

    $signature = strtoupper(md5($str));

    if ($signature != $json->signature) {
        //throw new IllegalRequestException("invalid signature. post data is " . $content . " and splice = ". $str ." signature = ".$signature);
        throw new IllegalRequestException("invalid signature. post data is " . $content );
    }

    $message = json_decode($json->message);

    // place your code here, use $message

    exit("ok");
} catch (Exception $ex) {
    exit($ex);
}



