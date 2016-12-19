<?php

/**
 * 图片上传服务
 */
class UploadService
{
    private $client;

    public function __construct($rpc_client)
    {
        $this->client = $rpc_client;
    }

    /** 上传图片文件
     * @param $file_content 图片文件内容
     * @return mixed
     */
    public function upload_image($file_content)
    {
        return $this->client->call("eleme.file.uploadImage", array("image" => base64_encode($file_content)));
    }

    /** 根据url上传图片
     * @param $url
     * @return mixed
     */
    public function upload_image_with_remote_url($url)
    {
        return $this->client->call("eleme.file.uploadImageWithRemoteUrl", array("url" => $url));
    }

    /** 获取上传图片的访问URL
     * @param $hash
     * @return mixed
     */
    public function get_uploaded_url($hash)
    {
        return $this->client->call("eleme.file.getUploadedUrl", array("hash" => $hash));
    }
}