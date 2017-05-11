<?php

namespace app\Common\model;

use think\Model;

class City extends Model
{
    //获得一级城市
    public function getNormalCityByParentId($parent_id =0){
        $data=[
            'status'=>1,
            'parent_id'=>$parent_id,
        ];
        $order =[
            'id'=>'desc',
        ];

        return $this->where($data)->order($order)->select();
    }
    public function getNormalCitys(){
        $data=[
            'status'=>1,
            'parent_id'=>['neq',0],
        ];
        $order = ['id'=>'desc'];
        return $this->where($data)->order($order)->select();
    }
}
