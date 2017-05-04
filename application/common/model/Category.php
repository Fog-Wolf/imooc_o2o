<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
    //自动赋值当前时间
    protected $autoWriteTimestamp=true;
    public function add($data){
        $data['status'] = 1;
//        $data['create_time'] = time();
        return $this->save($data);
    }
    //获取一级栏目
    public function getNormalFristCategory(){
        $data=[
            'status' =>1,
            'parent_id' =>0,
        ];
        $order = [
            'id'=>'desc',
        ];
        return $this->where($data)
            ->order($order)
            ->select();
    }
}