<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/8 3:50 下午
 * description : 接收指令消息，处理指令时，实现此接口
 */

interface Gring_Hi_Contracts_EventHandlerInterface {
    /**
     * @param mixed $payload
     */
    public function handle($payload);
}