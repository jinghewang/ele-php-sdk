# PHP SDK 接入指南 & CHANGELOG

## 接入指南
  1. PHP version >= 5.4 & curl extension support
  2. 修改config.php中的app_key和secret配置，将发者中心后台申请的应用沙箱环境的app_key和secret分别填入配置文件
  3. 使用sdk提供的接口进行开发调试
  4. 上线前将config.php中$sandbox值设为false以及填入正式环境的key和secret
 

## 代码示例
  - 第一步 引入sdk和配置文件
  
```php
    require dirname(__FILE__)."/../library/include.php";
```
 
  - 第二步 实例化一个oauth2.0客户端授权模式的授权对象
  
```php
    $client = new ClientCredentials(APP_KEY, APP_SECRET, ACCESS_TOKEN_URL);
```

  - 第三步 获取token对象,此步获取到的token对象可在有效期内一直使用，不用每次调用前都去获取一次，建议应用授权一次后存放到全局缓存中

```php
    $result = $client->get_access_token();
    //eg: {"access_token":"a9b23de907e69656d91069d9d23b771e","token_type":"bear","expires_in":86400000}
```

  - 第四步 实例化远程调用的client对象

```php
    $rpc_client = new RpcClient($result->access_token, APP_KEY, APP_SECRET, API_SERVER_URL);
```

  - 第五步 实例化一个服务对象

```php
    $shop = new ShopService($rpc_client);
```

  - 第六步 调用服务方法，获取资源数据

```php
    $info = $shop->get_shop(123456);
```



## CHANGELOG:
  
### [v1.0.0]

    Release Date : 2016-11-15

- [Feature] sdk完整实现
- [Feature] 增加接口调用代码示例 demo/index.php
- [Feature] 增加回调消息签名验证代码示例 demo/callback.php