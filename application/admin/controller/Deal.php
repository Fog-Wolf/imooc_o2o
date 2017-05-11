<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Deal extends Controller
{
    private $obj;
    public function _initialize()
    {
        $this->obj =model("Deal");
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $data = input("get.");
        $sdata=[];
        if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['end_time'])>strtotime($data['start_time'])){
            $sdata['create_time']=[
                ['gt',strtotime($data['start_time'])],
                ['lt',strtotime($data['end_time'])]
            ];
        }
        if(!empty($data['category_id'])){
            $sdata['category_id']=$data['category_id'];
        }
        if (!empty($data['category_id'])){
            $sdata['city_id']=$data['city_id'];
        }
        if (!empty($data['name'])){
            $sdata['name']=['like','%'.$data['name'].'%'];
        }
        $deals=$this->obj->getNormalDeals($sdata);
        $cityArrs=$categoryArrs=[];
        $categorys = model("Category")->getCategoryByParentId();
        foreach ($categorys as $category){
            $categoryArrs[$category->id]=$category->name;

        }

        $citys = model("City")->getNormalCitys();
        foreach ($citys as $city){
            $cityArrs[$city->id]=$city->name;

        }
        return $this->fetch('',[
            'categorys'=>$categorys,
            'citys'=>$citys,
            'deals'=>$deals,
            'category_id'=>empty($data['category_id']) ? '':$data['category_id'],
            'city_id'=>empty($data['city_id']) ? '':$data['city_id'],
            'name'=>empty($data['name']) ? '':$data['name'],
            'start_time'=>empty($data['start_time']) ? '':$data['start_time'],
            'end_time'=>empty($data['end_time']) ? '':$data['end_time'],
            'cityArrs'=>$cityArrs,
            'categoryArrs'=>$categoryArrs,
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
