<?php


/**
 * 店铺服务
 */
class ShopService
{
    private $client;

    /**
     * ShopService constructor.
     * @param $rpc_client
     */
    public function __construct($rpc_client)
    {
        $this->client = $rpc_client;
    }

    /** 获取店铺详情
     * @param $shop_id
     * @return mixed
     */
    public function  get_shop($shop_id)
    {
        return $this->client->call("eleme.shop.getShop", array("shopId" => $shop_id));
    }

    /** 更新店铺信息
     * @param $shop_id 店铺id
     * @param array $properties 店铺属性
     * @return mixed
     */
    public function update_shop($shop_id, $properties)
    {
        return $this->client->call("eleme.shop.updateShop", array("shopId" => $shop_id, "properties" => $properties));
    }

    /** 批量获取店铺状态
     * @param array $shop_ids
     * @return mixed
     */
    public function mget_shop_status(array $shop_ids)
    {
        return $this->client->call("eleme.shop.mgetShopStatus", array("shopIds" => $shop_ids));
    }


    /** 批量获取店铺状态
     * @param array $shop_id
     * @return mixed
     */
    public function getShopCategories($shop_id)
    {
        return $this->client->call("eleme.product.category.getShopCategories", array("shopId" => $shop_id));
    }

    /** 批量获取店铺状态
     * @param array $shop_id
     * @param $properties
     * @return mixed
     */
    public function createCategory($shop_id,$properties)
    {
        return $this->client->call("eleme.product.category.createCategory", $properties);
    }



    /** 更新店铺信息
     * @param $shop_id 店铺id
     * @param array $properties 店铺属性
     * @return mixed
     */
    public function createItem($categoryId, $properties)
    {
        return $this->client->call("eleme.product.item.createItem", array("categoryId" => $categoryId, "properties" => $properties));
    }


    /** 更新店铺信息
     * @param $shop_id 店铺id
     * @param array $properties 店铺属性
     * @return mixed
     */
    public function getItem($itemId)
    {
        return $this->client->call("eleme.product.item.getItem", array("itemId" => $itemId));
    }


    /** 更新店铺信息
     * @param $shop_id 店铺id
     * @param array $properties 店铺属性
     * @return mixed
     */
    public function getItemsByCategoryId($categoryId)
    {
        return $this->client->call("eleme.product.item.getItemsByCategoryId", array("categoryId" => $categoryId));
    }


    /** 更新店铺信息
     * @param $shop_id 店铺id
     * @param array $properties 店铺属性
     * @return mixed
     */
    public function getNonReachedMessages($appId)
    {
        return $this->client->call("eleme.message.getNonReachedMessages", array("appId" => $appId));
    }


    /** 更新店铺信息
     * @param $shop_id 店铺id
     * @param array $properties 店铺属性
     * @return mixed
     */
    public function getOrder($orderId)
    {
        return $this->client->call("eleme.order.getOrder", array("orderId" => $orderId));
    }

    /** 确认订单
     * @param $orderId
     * @return mixed
     * @internal param 店铺id $shop_id
     */
    public function confirmOrder($orderId)
    {
        return $this->client->call("eleme.order.confirmOrder", array("orderId" => $orderId));
    }

}