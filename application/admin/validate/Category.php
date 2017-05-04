<?php
/**
 * Created by PhpStorm.
 * User: 16425
 * Date: 2017/5/4
 * Time: 15:59
 */
namespace app\admin\validate;
use think\Validate;

class Category extends Validate{
    protected $rules =[
        ['name','require|max:10','分类名必须填写|最多10个字符'],
        ['parent_id','number'],
        ['id','number'],
        ['status','number|in:-1,0,1','状态必须是数字|状态范围不合法'],
        ['listorder','number'],
    ];
    /**
     * 场景设置
     */
    protected $scene = [
        'add' =>['name','parent_id'],//添加
        'listorder'=>['id','listorder'],//排序
    ];
}

