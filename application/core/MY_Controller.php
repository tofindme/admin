<?php

/**
 * 所有继承MY_Controller的类都执行函数
 * 也可以用Hook来完成类似动作session检查等
 *
 */
class MY_Controller extends CI_Controller {

    public $return = array(
        'statusCode' => '301',
        'message' => '登陆失效，请重新登录!',
        'navTabId' => '',
        'rel' => '',
        'callbackType' => 'closeCurrent',
        'forwardUrl' => ''
    );

    public function __construct() {
        parent::__construct();
    }
}

