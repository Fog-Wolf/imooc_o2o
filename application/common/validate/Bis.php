<?php
/**
 * Created by PhpStorm.
 * User: 16425
 * Date: 2017/5/8
 * Time: 14:13
 */
namespace app\common\validate;
use think\Validate;
class Bis extends Validate
{
    protected $rule =[
//        'name' =>'require|max:25',
//        'email'=>'email',
//        'logo'=>'require',
//        'city_id'=>'require',
//        'bank_info'=>'require',
//        'bank_name'=>'require',
//        'bank_user'=>'require',
//        'faren'=>'require',
//        'faren_tel'=>'require',
        ['name','require|max:25'],
        ['email','email'],
        ['logo','require'],
        ['city_id','require'],
        ['bank_info','require'],
        ['bank_name','require'],
        ['bank_user','require'],
        ['faren','require'],
        ['faren_tel','require'],
        ['contact','require'],
        ['tel','require|length:13'],
        ['username','require|min:6'],
        ['password','require'],
    ];

    //场景设置
    protected  $scene=[
        'add'=>['name','email','logo','city_id','bank_info','bank_name','bank_user','faren','faren_tel'],
        'first' =>['contact','tel'],
        'username'=>['username','password'],
        'addStore'=>['name','logo','contact','tel'],//用户分店添加检验
        'deal' =>['name'],//团购检验
    ];
}