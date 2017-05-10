<?php
/**
 * Created by PhpStorm.
 * User: 16425
 * Date: 2017/5/8
 * Time: 14:57
 */
namespace app\common\model;

use think\Model;

class BisAccount extends BaseModel
{
    public function updateById($data,$id){
        //allowfield 过滤data数组中的非数据表中的数据
        return $this->allowField(true)->save($data,['id'=>$id]);
    }
}