<?php

/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/7 8:47 下午
 * description :
 */

abstract class Gring_Hi_Messages_Message implements Gring_Hi_Contracts_MessageInterface {

    /**
     * @var array
     */
    protected $attributes = array();


    private $allowType = array(
        'AT',
        'MD',
        'LINK',
        'TEXT',
        'IMAGE',
    );

    /**
     * Gring_Hi_Messages_Message constructor.
     * @param $value
     * @param  string  $attribute
     */
    public function __construct($value = '', $attribute = 'content') {
        $this->setAttribute($attribute, $value);
    }

    /**
     * @return array
     */
    public function getType() {
        $className = explode('_', get_class($this));
        $type = strtoupper(array_pop($className));
        if (!in_array($type, $this->allowType)) {
            throw new InvalidArgumentException(sprintf('type [%s] is not supported.', $type));
        }

        return array_combine(array('type'), array($type));
    }

    /**
     * @param  array  $attributes
     * @return $this
     */
    public function setAttributes($attributes = array()) {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
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
     * @return bool
     */
    public function isRequired($attribute) {
        return in_array($attribute, $this->getRequired(), true);
    }

    /**
     * @return array|mixed
     */
    public function getRequired() {
        return property_exists($this, 'required') ? $this->required : array();
    }

    /**
     * @return array
     */
    public function getContent() {
        return array_combine(array('content'), array($this->attributes['content'] . "\n"));
    }

    /**
     * @return array
     */
    public function getBody() {
        return array_merge(
            $this->getType(),
            $this->getContent()
        );
    }

    /**
     * @param $attribute
     * @return mixed
     */
    public function __get($attribute) {
        return $this->attributes[$attribute];
    }

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function __set($attribute, $value) {
        return $this->attributes[$attribute] = $value;
    }

}