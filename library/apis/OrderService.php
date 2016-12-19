<?php

/**
 * 订单服务
 */
class OrderService
{
    private $client;

    public function __construct($rpc_client)
    {
        $this->client = $rpc_client;
    }

    /** 根据订单号获取订单详情
     * @param $order_id
     * @return mixed
     */
    public function  get_order($order_id)
    {
        if (!is_string($order_id)) {
            trigger_error('given string please');
            return;
        }
        return $this->client->call("eleme.order.getOrder", array("orderId" => $order_id));
    }

    /** 批量获取订单详情
     * @param array $order_ids 订单号数组，单次最多返回50条
     * @return mixed
     */
    public function mget_orders(array $order_ids)
    {
        return $this->client->call("eleme.order.mgetOrders", array("orderIds" => $order_ids));
    }

    /** 确认订单
     * @param $order_id
     * @return mixed
     */
    public function confirm_order($order_id)
    {
        return $this->client->call("eleme.order.confirmOrder", array("orderId" => $order_id));
    }

    /** 取消订单
     * @param $order_id
     * @param $type 取消类型
     * @param $remark 备注原因
     * @return mixed
     */
    public function cancel_order($order_id, $type, $remark)
    {
        return $this->client->call("eleme.order.cancelOrder", array("orderId" => $order_id, "type" => $type, "remark" => $remark));
    }

    /** 同意用户申请的退单
     * @param $order_id
     * @return mixed
     */
    public function agree_refund($order_id)
    {
        return $this->client->call("eleme.order.agreeRefund", array("orderId" => $order_id));
    }

    /** 拒绝用户申请的退单
     * @param $order_id
     * @param $reason
     * @return mixed
     */
    public function disagree_refund($order_id, $reason)
    {
        return $this->client->call("eleme.order.disagreeRefund", array("orderId" => $order_id, "reason" => $reason));
    }
}