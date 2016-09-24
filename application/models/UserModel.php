<?php

/**
 *UserModel
 *
 *
 *
 *
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    private $uid; //用户id
    private $uname; //用户名

    public function __construct()
    {
        parent::__construct();
        $this->uid = $this->session->userdata('uid');
        $this->uname = $this->session->userdata('uname');
    }

    //保存用户登录后session数据
    public function saveUserSession($data = array())
    {
        $this->session->set_userdata($data);
    }

    public function getUserId()
    {
        return $this->uid;
    }

    //获取用户名
    public function getUsername()
    {
        return $this->uname;
    }

    //检查数据
    public function checkUser()
    {
        if (empty($this->uid) || empty($this->uname)){
            return FALSE;
        }else{
            return array("uid" => $this->uid, "uname" => $this->uname, "urole" => $this->urole);
        }
    }

    //授权用户
    public function authUser($name, $pwd)
    {

    }

    //得到用户的权限
    public function getMenus()
    {

    }
}

