<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/7 8:37 下午
 * description : 响应超链接
 */

class Gring_Hi_Messages_Link extends Gring_Hi_Messages_Message {
    public function getContent() {
        return array('href' => $this->attributes['content'] . "\n");
    }
}