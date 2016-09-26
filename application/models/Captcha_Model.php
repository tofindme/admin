<?php

/**
 * Encoding     :  UTF-8
 * Created on   :  2014-6-4 by Tom , xiuluo_0816@163.com
 * WebSite      :  www.statnet.com.cn
 */
class Captcha_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('captcha');
    }

    /**
     * 创建自己的验证码
     * @return type
     */
    public function createCaptcha() {
        /*
         * 生成验证码
         * 'image' => IMAGE TAG
         * 'time' => TIMESTAMP (毫秒)
         * 'word' => s8sj
         */
        $captcha = create_captcha(config_item('captcha'));
        //将验证码放入session中
        $this->session->set_userdata('captcha', $captcha['word']); //存放到session
        return $captcha;
    }

    /**
     * 删除session中的验证码
     */
    public function deleteCaptcha() {
        $this->session->unset_userdata('captcha');
    }

}

?>

