<?php
/**
 * Created by PhpStorm.
 * User: 16425
 * Date: 2017/5/12
 * Time: 13:52
 */
namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        //获取值
        $data = input('get.');
        if (empty($data['id'])){
            $this->error('id不合法');
        }
        if (!is_numeric($data['status'])){
            $this->error('status不合法');
        }

        //获取控制器
        $model = request()->controller();
        $res=model($model)->save(['status'=>$data['status']],['id'=>$data['id']]);
        if ($res){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }

    }
}