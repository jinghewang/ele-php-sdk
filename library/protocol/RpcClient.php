<?php

class RpcClient
{
    private $app_key;
    private $secret;
    private $remote_url;
    private $token;

    public function __construct($token, $app_key, $secret, $remote_url)
    {
        if (is_null($token)
            || is_null($app_key)
            || is_null($secret)
            || is_null($remote_url)
        ) {

            throw new InvalidArgumentException("invalid construct parameters.");
        }

        $this->token = $token;
        $this->app_key = $app_key;
        $this->secret = $secret;
        $this->remote_url = $remote_url;
    }

    /** call server api with nop
     * @param $action
     * @param array $parameters
     * @return mixed
     * @throws BusinessException
     * @throws Exception
     */
    public function call($action, array $parameters)
    {
        $protocol = array(
            "nop" => '1.0.0',
            "id" => $this->create_uuid(),
            "action" => $action,
            "token" => $this->token,
            "metas" => array(
                "app_key" => $this->app_key,
                "timestamp" => time(),
            ),
            "params" => $parameters,
        );
        $protocol['signature'] = $this->generate_signature($protocol);
        $result = $this->post($this->remote_url, $protocol);
        $response = json_decode($result);
        if (is_null($response)) {
            throw new Exception("invalid response.");
        }

        if (isset($response->error)) {
            switch ($response->error->code) {
                case "SERVER_ERROR":
                    throw new ServerErrorException($response->error->message);
                case "ILLEGAL_REQUEST":
                    throw new IllegalRequestException($response->error->message);
                case "UNAUTHORIZED":
                    throw new UnauthorizedException($response->error->message);
                case "ACCESS_DENIED":
                    throw new PermissionDeniedException($response->error->message);
                case "METHOD_NOT_ALLOWED":
                    throw new PermissionDeniedException($response->error->message);
                case "PERMISSION_DENIED":
                    throw new PermissionDeniedException($response->error->message);
                case "EXCEED_LIMIT":
                    throw new ExceedLimitException($response->error->message);
                case "INVALID_SIGNATURE":
                    throw new InvalidSignatureException($response->error->message);
                case "INVALID_TIMESTAMP":
                    throw new InvalidTimestampException($response->error->message);
                case "VALIDATION_FAILED":
                    throw new ValidationFailedException($response->error->message);
                default:
                    throw new BusinessException($response->error->message);
            }
        }

        return $response->result;
    }

    private function generate_signature($protocol)
    {
        $merged = array_merge($protocol['metas'], $protocol['params']);
        ksort($merged);
        $string = "";
        foreach ($merged as $key => $value) {
            $string .= $key . "=" . json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
        $splice = $protocol['action'] . $this->token . $string . $this->secret;
        return strtoupper(md5($splice));
    }

    private function create_uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    private function post($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json; charset=utf-8"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        return $response;
    }
}
