<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    private $name;
    private $password;

    public function __construct() {
        parent::__construct();
        $this->load->model('Captcha_Model', 'captcha_model');
        $this->load->helper('form');
    }

    /**
     * 后台登陆
     */
    public function index($info = '') {

        //$this->load->model('admin/User_Model');
        //$userinfo = $this->User_Model->checkUserinfo();
        //if ($userinfo !== FALSE) {
        //    Header("Location: " . site_url('admin/index'));
        //}

        //加入自定义验证码类
        /*
         * 生成验证码
         * 'image' => IMAGE TAG
         * 'time' => TIMESTAMP (毫秒)
         * 'word' => s8sj
         */
        $data['captcha'] = $this->captcha_model->createCaptcha();
        $data['login_error'] = $info;
        //渲染试图
        $this->load->view('admin/login', $data);
    }

    /**
     * 处理登陆信息
     */
    public function dologin() {

        if ($this->checkForm() == FALSE) {
            //表单验证失败,返回登录
            $this->index();
        } else {
            //验证用户名密码
            $this->userinfo = $this->checkUser();
            if (!empty($this->userinfo)) {

                //登录成功
                $this->captcha_model->deleteCaptcha();
                //存放session
                $this->load->model('admin/User_Model');
                $this->User_Model->save_user_session($this->userinfo);

                //redirect('admin/index');
                Header("Location: " . site_url('admin/index'));
            } else {
                $this->index('<p>用户名或密码错误！</p>');
            }
        }
    }

    /**
     *
     * @return type验证表单
     */
    public function checkForm() {
        /*
         * 表单验证规则
         * required 不为空
         * callback_authCheck 回调函数验证 authCheck()
         */
        $this->form_validation->set_rules('name', '用户名', 'required');
        $this->form_validation->set_rules('password', '密码', 'required');
        $this->form_validation->set_rules('code', '验证码', 'required');
        $this->form_validation->set_rules('code', 'Code', 'callback_authCheck');
        /*
         * 自定义验证显示内容
         */
        $this->form_validation->set_message('required', '%s 不能为空！');
        return $this->form_validation->run();
    }

    /**
     * 查询用户是否存在
     * @return Array or array()
     */
    public function checkUser() {
        $this->name = $this->input->post('name');
        $this->password = $this->input->post('password');
        $where = array('name' => $this->name, 'password' => md5($this->password));
        $fields = array('id as userid,name,roleid,realname,dateline,lasttime');
        return $this->Database_Model->get_table_row('default', 'admin', $where, $fields);
    }

    /**
     * 验证验证码是否正确
     * @param type $code 表单输入的验证码
     * @return boolean
     */
    public function authCheck($code) {
        if (strcmp(strtoupper($code), strtoupper($this->session->userdata('captcha'))) != 0) {
            $this->form_validation->set_message('authCheck', '验证码 输入错误！');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * 登录注销
     */
    public function logout() {
        $this->session->sess_destroy();
        if (empty($this->userid) && empty($this->username)) {
            redirect('admin/login');
        } else {
            echo '注销失败!';
        }
    }

    /**
     * 更换验证码
     */
    public function changeCode() {
        $cap = $this->captcha_model->createCaptcha();
        exit($cap['time']);
    }

}


