<?php
/**
 * Created by PhpStorm.
 * User: 16425
 * Date: 2017/5/8
 * Time: 14:57
 */
namespace app\common\model;

use think\Model;

class Bis extends Model
{
    protected $autoWriteTimestamp=true;
    public function add($data){
        $data['status']=0;
        $this->save($data);
        return $this->id;
    }
}