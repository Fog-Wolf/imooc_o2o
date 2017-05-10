<?php
/**
 * Created by PhpStorm.
 * User: 16425
 * Date: 2017/5/10
 * Time: 13:58
 */
namespace app\bis\controller;
use think\Controller;
class Base extends Controller
{
    private $account;
    public function _initialize()
    {
       //判断用户是否登陆
        $isLogin = $this->isLogin();
        if (!$isLogin){
            return $this->redirect(url('login/index'));
        }
    }
    //判断是否登陆
    public function isLogin()
    {
        //获取session
        $user =$this->getLoginUser();
        if ($user && $user->id){
            return true;
        }else{
            return false;
        }
    }
    public function getLoginUser(){
        if(! $this->account){
            $this->account =session('bisAccount','','bis');
        }
        return $this->account;
    }
}