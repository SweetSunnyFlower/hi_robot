<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/8 4:21 下午
 * description : 示例
 */

class Gring_Hi_Handlers_Catch implements Gring_Hi_Contracts_EventHandlerInterface {

    /**
     * @example
     * @param  null  $payload
     * @throws Exception
     */
    public function handle($payload) {
        (new Gring_Hi_Robot(
            $payload['webhook']
        ))->addAttaches(
            [
                new Gring_Hi_Messages_Md('### '.json_encode($payload['messages'])),
                //                new Gring_Hi_Messages_Text('what if'),
                //                new Gring_Hi_Messages_Link('http://www.baidu.com'),
                //                new Gring_Hi_Messages_At(array()),
                //                (new Gring_Hi_Messages_Image('https://static.oschina.net/uploads/space/2018/0309/190636_CiqD_423674.png')),
            ]
        )->response();
    }
}
