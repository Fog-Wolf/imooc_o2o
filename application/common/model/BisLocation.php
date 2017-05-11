<?php
/**
 * Created by PhpStorm.
 * User: 16425
 * Date: 2017/5/8
 * Time: 14:57
 */
namespace app\common\model;

use think\Model;

class BisLocation extends BaseModel
{
    public function getBisLocationByUser($user){
        $order =[
            'id'=>'desc',
        ];
        $data=[
            'bis_id'=>$user,
            'is_main'=>0
        ];
        $res = $this->where($data)->order($order)->paginate(3);
        return $res;
    }
    public function getNormalLocationByBisId($bisid){
         $data=[
             'bis_id'=>$bisid,
             'status'=>1,
         ];
        $result = $this->where($data)->order('id','desc')->select();
        return $result;
    }

}