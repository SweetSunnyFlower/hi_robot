<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/7 8:37 下午
 * description : 响应提示
 */

class Gring_Hi_Messages_At extends Gring_Hi_Messages_Message {

    public function getContent() {
        return $this->attributes['content'] ? array('atuserids' => $this->attributes['content']) : array('atall' => true);
    }
}