<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/8 4:40 下午
 * description : 处理hi 发送的信息
 */

class Gring_Hi_Payload {

    public $attributes;

    private $ignoreAttributes = array('body');

    public function __construct($payload) {
        $this->payloadSpread($payload);
        $this->parseBody($payload);
    }

    /**
     * @param $payload
     * @param $parentKey
     */
    private function payloadSpread($payload, $parentKey = null) {
        foreach ($payload as $key => $value) {
            if (in_array($key, $this->ignoreAttributes)){
                continue;
            }
            $prefixKey = $parentKey ? $parentKey.ucwords($key) : $key;
            if (is_array($value)) {
                $this->payloadSpread($value, $prefixKey);
            } else {
                $this->attributes[$prefixKey] = $value;
            }
        }
    }

    public function parseBody($payload){
        $body = $payload['message']['body'];
        $command = array_shift($body);
        $this->setAttribute('messages', $body);
        if ( 'AT' === strtoupper($command['type'])){
            $this->setAttribute('commandName', strtoupper($command['name']));
        }
        if ('COMMAND' === strtoupper($command['type'])){
            $this->setAttribute('commandName', strtoupper($command['commandname']));
        }
    }


    /**
     * @param $attribute
     * @param $value
     * @return $this
     */
    public function setAttribute($attribute, $value) {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * @param $attribute
     * @param  null  $default
     * @return mixed|null
     */
    public function getAttribute($attribute, $default = null) {
        return $this->attributes[$attribute] ?: $default;
    }

    /**
     * @param $attribute
     * @param $value
     * @return $this
     */
    public function __set($attribute, $value) {
        $this->attributes[$attribute] = $value;

        return $this;
    }

    /**
     * @param $attribute
     * @return mixed
     */
    public function __get($attribute) {
        return $this->attributes[$attribute];
    }

}