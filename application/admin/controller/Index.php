<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {

        return $this->fetch();
    }
    public function welcome(){
//        echo "欢迎登陆<br/>";
//        //显示连接经纬度
        //return \Map::getLngLat('上海');

        //\phpmailer\Email::send('1054243883@qq.com','tp5-test','success-hello');
        return '成功';
    }
    public function map(){
        //生成静态图API
        return \Map::staticimage('上海');
    }
}
