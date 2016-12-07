<?php

/**
 * 商品分类管理
 */
class ProductCategoryService
{
    private $client;

    public function __construct($rpc_client)
    {
        $this->client = $rpc_client;
    }

    /** 获取店铺商品分类目录
     * @param $shop_id
     * @return mixed
     */
    public function  get_shop_categories($shop_id)
    {
        return $this->client->call("eleme.product.category.getShopCategories", array("shopId" => $shop_id));
    }

    /** 获取某个商品分类的详情
     * @param $category_id
     * @return mixed
     */
    public function get_category($category_id)
    {
        return $this->client->call("eleme.product.category.getCategory", array("categoryId" => $category_id));
    }

    /**  创建一个商品分类
     * @param $shop_id 店铺id
     * @param $name 分类名称
     * @param $description 分类描述
     * @return mixed
     */
    public function create_category($shop_id, $name, $description)
    {
        return $this->client->call("eleme.product.category.createCategory", array("shopId" => $shop_id, "name" => $name, "description" => $description));
    }

    /** 更新一个商品分类
     * @param $category_id 分类id
     * @param $name 分类名称
     * @param $description 分类描述
     * @return mixed
     */
    public function update_category($category_id, $name, $description)
    {
        return $this->client->call("eleme.product.category.updateCategory", array("categoryId" => $category_id, "name" => $name, "description" => $description));
    }

    /** 删除一个商品分类
     * @param $category_id
     * @return mixed
     */
    public function remove_category($category_id)
    {
        return $this->client->call("eleme.product.category.removeCategory", array("categoryId" => $category_id));
    }
}