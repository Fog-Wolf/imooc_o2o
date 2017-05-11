<?php

namespace app\bis\controller;

use think\Controller;
use think\Request;

class Deal extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
        $bisid=$this->getLoginUser()->bis_id;
        $deal = model('Deal')->getNormalDealByBisId($bisid);
        return $this->fetch('',[
            'deal'=>$deal,
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        $bisid=$this->getLoginUser()->bis_id;
        if (request()->isPost()){
            $data = input("post.");
            $location = model('BisLocation')->get($data['location_ids'][0]);
            $validate =validate('Bis');
            if (!$validate->scene('deal')->check($data)){
                $this->error($validate->getError());
            }
            $deals=[
                'bis_id'=>$bisid,
                'name'=>$data['name'],
                'image'=>$data['image'],
                'category_id'=>$data['category_id'],
                'se_category_id'=>empty($data['se_category_id'])? '':implode(',',$data['se_category_id']),
                'city_id'=>$data['city_id'],
                'location_ids'=>empty($data['location_ids'])? '':implode(',',$data['location_ids']),
                'start_time'=>strtotime($data['start_time']),
                'end_time'=>strtotime($data['end_time']),
                'total_count'=>$data['total_count'],
                'origin_price'=>$data['origin_price'],
                'current_price'=>$data['current_price'],
                'coupons_begin_time'=>strtotime($data['coupons_begin_time']),
                'coupons_end_time'=>strtotime($data['coupons_end_time']),
                'notes'=>$data['notes'],
                'description'=>$data['description'],
                'bis_account_id'=>$this->getLoginUser()->id,
                'xpoint'=>$location->xpoint,
                'ypoint'=>$location->ypoint,
            ];
            $id = model('Deal')->add($deals);
            if($id){
                $this->success('添加成功',url('deal/index'));
            }else{
                $this->error('添加失败');
            }
        }else {
            //获取一级城市的数据
            $citys = model('City')->getNormalCityByParentId();
            //获取一级栏目的数据
            $categorys = model('Category')->getCategoryByParentId();
            return $this->fetch('', [
                'citys' => $citys,
                'categorys' => $categorys,
                'bislocations' => model('BisLocation')->getNormalLocationByBisId($bisid),
            ]);
        }
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
