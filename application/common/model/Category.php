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

    //获取选项中一级栏目
    public function getNormalFirstCategory(){
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
    //获取页面一级栏目
    public function getFirstCategory($parentid = 0){
        $data = [
            'parent_id'=>$parentid,
            'status' =>['neq',-1],
        ];
        $order =[
            'listorder'=>'desc',
            'id'=>'desc',
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate();//分页
        //显示sql语句
//        echo $this->getLastSql();
        return $result;

    }
    public function getCategoryByParentId($parent_id =0){
        $data=[
            'status'=>1,
            'parent_id'=>$parent_id,
        ];
        $order =[
            'id'=>'desc',
        ];

        return $this->where($data)->order($order)->select();
    }
}