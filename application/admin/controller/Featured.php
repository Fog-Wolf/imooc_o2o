<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Featured extends Base
{
    private $obj;
    public function _initialize()
    {
       $this->obj=model('Featured');
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //获取推荐位类别
        $types = config('featured.featured_type');
        $type=input('get.type',0,'intval');
        //获取数据列表
        $result = $this->obj->getFeaturedByType($type);
        return $this->fetch('',[
            'types'=>$types,
            'result'=>$result,
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        //
        if (request()->isPost()){
            //入库逻辑
            $data=input('post.');
           $id =$this->obj->add($data);
            if ($id){
                $this->success('成功');
            }else{
                $this->error('失败');
            }
        }else{
            //获取推荐位类别
            $type = config('featured.featured_type');
            return $this->fetch('',[
                'type'=>$type,
            ]);
        }
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
//    public function delete()
//    {
//        //获取值
//        $data = input('get.');
//        $res=$this->obj->save(['status'=>$data['status']],['id'=>$data['status']]);
//        if ($res){
//            $this->success('更新成功');
//        }else{
//            $this->error('更新失败');
//        }
//
//    }
}
