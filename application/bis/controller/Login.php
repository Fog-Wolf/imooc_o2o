<?php
namespace app\bis\controller;
use think\Controller;
class Login extends Controller
{
    public function index(){
        if (request()->isPost()){
            //登陆的逻辑
            //获取数据
            $data=input('post.');
            //通过用户名获取用户相关数据
            $validate = validate('Category');
            if (!$validate->scene('username')->check($data)){
                $this->error($validate->getError());
            }
            $res = model('BisAccount')->get(['username'=>$data['username']]);
            if(!$res || $res->status !=1){
                $this->error('该用户不存在或者用户未被审核通过');
            }
            if ($res->password !=md5($data['password'].$res->code)){
                $this->error('密码不正确');
            }
            model('BisAccount')->updateById(['last_login_time'=>time()],$res->id);
            //保存用户信息,bis是作用域
            session('bisAccount',$res,'bis');
            return $this->success('登陆成功',url('index/index'));
        }else{
            //获取sessIon
            $account = session('bisAccount','','bis');
            if ($account && $account->id){
                return $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }

    }
    //退出登陆
    public function logout(){
        //清除Ssession
        session(null,'bis');
        //退出
        return $this->redirect(url('login/index'));
    }
}