<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Bis extends Controller
{
    private $obj;
    public function _initialize()
    {
       $this->obj =model("Bis");
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        return $this->fetch();
    }
    /**
     * 商户入驻申请
     */
    public function apply(){
        $bis= $this->obj->getBisByStatus();

        return $this->fetch('',[
            'bis'=>$bis,
        ]);
    }

    public function detail(){
        $id = input('get.id');
        if (empty($id)){
            return $this->error('ID错误');
        }
        //获取一级城市的数据
        $citys = model('City')->getNormalCityByParentId();
        //获取一级栏目的数据
        $categorys = model('Category')->getCategoryByParentId();
        //获取商户数据
        $bisdata = model('Bis')->get($id);
        $locationdata =model('BisLocation')->get(['bis_id'=>$id,'is_main'=>1]);
        $accountdata = model('BisAccount')->get(['bis_id'=>$id,'is_main'=>1]);
        return $this->fetch('',[
            'citys'=>$citys,
            'category'=>$categorys,
            'bisdata'=>$bisdata,
            'locationdata'=>$locationdata,
            'accountdata'=>$accountdata,

        ]);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id,$status)
{
    //
    $data=input('get.');
    $data =[
        'id'=>intval($id),
        'status'=>intval($status),
    ];
    $validate = validate('Category');
    if (!$validate->scene('status')->check($data)){
        $this->error($validate->getError());
    }
    $res = $this->obj->save(['status'=>$data['status']],['id'=>intval($data['id'])]);
    $location = model('BisLocation')->save(['status'=>$data['status']],['bis_id'=>$data['id']],'is_main=>1');
    $account = model('BisAccount')->save(['status'=>$data['status']],['bis_id'=>$data['id']],'is_main=>1');
    //echo $res;
    if ($res && $location && $account){
        if ($data['status']==1){
            $title ='o2o入驻申请通知';
            $content="您提交的入驻申请成功";
            \phpmailer\Email::send($data['email'],$title,$content);
        }elseif($data['status']==2){
            $title ='o2o入驻申请通知';
            $content="您提交的入驻申请未通过，请核实实际信息";
            \phpmailer\Email::send($data['email'],$title,$content);
        }
        $this->success('修改成功');
    }else{
        $this->error('修改失败');
    }
}
}
