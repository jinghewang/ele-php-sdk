<?php

/**
 * 消息服务
 */
class MessageService
{
    private $client;

    public function __construct($rpc_client)
    {
        $this->client = $rpc_client;
    }

    /** 获取推送未到达的消息，每次最多返回50条
     * @param $app_id
     * @return mixed
     */
    public function  get_non_reached_messages($app_id)
    {
        return $this->client->call("eleme.message.getNonReachedMessages", array("appId" => $app_id));
    }
}