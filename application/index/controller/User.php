<?php
namespace app\index\controller;
use think\Controller;

class User extends  Controller
{
    //用户登陆
    public function login()
    {
       return  $this->fetch();
    }
    //用户注册
    public function register()
    {
        return  $this->fetch();
    }
}
