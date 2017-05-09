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
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
