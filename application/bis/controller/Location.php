<?php

namespace app\bis\controller;

use think\Controller;
use think\Request;

class Location extends Base
{
    private $obj;
    public function _initialize()
    {
        $this->obj =model("BisLocation");
    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $user =$this->getLoginUser()->bis_id;

        $bis= $this->obj->getBisLocationByUser($user);
        return $this->fetch('',[
            'bis'=>$bis,
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        if (request()->isPost()){
            $data =input('post.');
            $bisid =$this->getLoginUser()->bis_id;
            $data['cat']='';
            if (!empty($data['se_category_id'])){
                $data['cat']=implode('|',$data['se_category_id']);
            }
            //获取经纬度
            $lnglat = \Map::getLngLat($data['address']);
            if (empty($lnglat)||$lnglat['status'] != 0 || $lnglat['result']['precise'] !=1){
                $this->error('无法获取数据，或者匹配不精准');
            }
            //1 校验数据
            $validate =validate('Bis');
            if (!$validate->scene('addStore')->check($data)){
                $this->error($validate->getError());
            }
            //门店入库操作
            //总店相关信息入库
            $locationData =[
                'bis_id'=>$bisid,
                'name'=>$data['name'],
                'tel'=>$data['tel'],
                'contact'=>$data['contact'],
                'category_id'=>$data['category_id'],
                'category_path'=>$data['category_id'].','.$data['cat'],
                'city_id'=>$data['city_id'],
                'city_path'=>empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
                'api_address'=>$data['address'],
                'open_time'=>$data['open_time'],
                'content'=>empty($data['content'])? '':$data['content'],
                'is_main'=>0,//代表的是分店信息
                'xpoint' =>empty($lnglat['result']['location']['lng'])? '':$lnglat['result']['location']['lng'],
                'ypoint' =>empty($lnglat['result']['location']['lat'])? '':$lnglat['result']['location']['lat'],
            ];
            $locationid = model('BisLocation')->add($locationData);
            if ($locationid){
                return $this->success('门店申请成功');
            }else{
                return $this->error('门店申请失败');
            }
        }else{
            //获取一级城市的数据
            $citys = model('City')->getNormalCityByParentId();
            //获取一级栏目的数据
            $categorys = model('Category')->getCategoryByParentId();


            return $this->fetch('',[
                'citys'=>$citys,
                'categorys'=>$categorys,
            ]);
        }
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
        $locationdata =model('BisLocation')->get(['bis_id'=>$id,'is_main'=>0]);
//        var_dump($locationdata);
//        exit;
        return $this->fetch('',[
            'citys'=>$citys,
            'category'=>$categorys,
            'bisdata'=>$bisdata,
            'locationdata'=>$locationdata,
        ]);
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
