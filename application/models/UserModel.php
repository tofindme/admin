<?php

/**
 *UserModel
 *
 *
 *
 *
 */

class UserModel extends CI_Model {

    private $uid; //用户id
    private $uname; //用户名
    private $urole; //用户角色，对应的权限(菜单)

    public function __construct()
    {
        parent::__construct();
        $this->uid = $this->session->userdata('uid');
        $this->uname = $this->session->userdata('uname');
        $this->urole = $this->session->userdata('urole');
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

    //获取用户角色
    public function getUserRole()
    {
        return $this->urole;
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

>
