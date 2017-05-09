<?php
/**
 * Created by PhpStorm.
 * User: 16425
 * Date: 2017/5/8
 * Time: 14:57
 */
namespace app\common\model;

use think\Model;

class Bis extends BaseModel
{
    /**
     * 通过状态获取数据
     * @param $status
     */
    public function getBisByStatus($status =0){
        $order =[
            'id'=>'desc',
        ];
        $data=[
            'status'=>$status,
        ];
        $res = $this->where($data)->order($order)->paginate(3);
        return $res;
    }
}