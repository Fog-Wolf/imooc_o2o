<?php

namespace app\common\model;

use think\Model;

class Deal extends BaseModel
{
    //
    public function getNormalDealByBisId($bisid){
        $data=[
            'bis_id' => $bisid,
        ];
        $result = $this->where($data)->order('id','desc')->select();
        return $result;
    }

    public function getNormalDeals($data=[]){
        $data['status']=1;
        $order =['id'=>'desc'];
        $result=$this->where($data)->order($order)->paginate(1);
        //echo $this->getLastSql();
        return $result;
    }
}
