<?php

class ClientCredentials
{
    private $client_id;
    private $secret;
    private $url;

    public function __construct($app_key, $secret, $url)
    {
        $this->client_id = $app_key;
        $this->secret = $secret;
        $this->url = $url;

        if (is_null($app_key) || is_null($secret) || is_null($url)) {
            throw new InvalidArgumentException("invalid initialize arguments.");
        }
    }

    public function get_access_token()
    {
        session_start();
        ini_set('session.gc_maxlifetime', "36000000"); // 秒
        ini_set("session.cookie_lifetime","36000000"); // 秒

        $key = '_access_token';
        if (!empty($_SESSION[$key]))
            return $_SESSION[$key];

        $request_response = $this->request();
        $response = json_decode($request_response);
        if (is_null($response)) {
            throw new Exception("illegal response :" . $request_response);
        }

        if (isset($response->error)) {
            throw new IllegalRequestException($response->error);
        }

        $_SESSION[$key] = $response;
        return $response;
    }

    private function request()
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Basic " . base64_encode(urlencode($this->client_id) . ":" . urlencode($this->secret)),
            "Content-Type: application/x-www-form-urlencoded; charset=utf-8"));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            "grant_type" => "client_credentials"
        )));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        return $response;
    }
}

