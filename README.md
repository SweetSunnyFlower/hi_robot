### hi robot library
#### 使用说明
```php
            //给hi 发送消息时
            $res = new Gring_Hi_Robot(
                 'webhook'
             );
             $res = $res->addAttaches(
                 array(
                     (new Gring_Hi_Messages_Md())->setTemplates([new Gring_Hi_Templates_Demo()])->convert(),
                     new Gring_Hi_Messages_Text('SweetSunnyFlower'),
                     new Gring_Hi_Messages_Link('http://www.baidu.com'),
                     new Gring_Hi_Messages_At(array()),
                     (new Gring_Hi_Messages_Image('https://static.oschina.net/uploads/space/2018/0309/190636_CiqD_423674.png')),
                 )
            )->response();

        //接收处理hi指令
        $params = array();
        $response = new Gring_Hi_Response('webhook');
        $response->bindPayload((new Gring_Hi_Payload($params['parseParams'])));
        $response->registerHandler('catch', Gring_Hi_Handlers_Catch::class);
        $response->registerHandler('robot', Gring_Hi_Handlers_Robot::class);
        $response->handle();
```
