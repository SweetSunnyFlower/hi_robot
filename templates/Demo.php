<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/9 3:24 下午
 * description : HTML 模板示例
 */

class Gring_Hi_Templates_Demo implements Gring_Hi_Contracts_TemplateInterface {

    public $parser;

    public function __construct(){
    }

    public function render() {
        return "<h1><em>倾斜</em></h1>";
        return " <table><tr><th>Month</th><th>Savings</th></tr><tr><td>January</td><td>$100</td></tr></table>";
    }
}