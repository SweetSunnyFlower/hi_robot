<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/7 8:34 下午
 * description : 发送消息时，实现此接口
 */

interface Gring_Hi_Contracts_MessageInterface {
    public function getType();
    public function getContent();
    public function getBody();
}