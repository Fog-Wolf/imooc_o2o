<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Category extends Controller
{
    private  $obj;
    public function _initialize()
    {
        $this->obj = model('Category');
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
       $parentid = input('get.parentid',0,'intval');
        $category = $this->obj->getFirstCategory($parentid);
        //显示页面
        return $this->fetch('',[
            'category'=>$category,
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        //获取数据库中的一级栏目
        $categorys = $this->obj->getNormalFirstCategory();
        return $this->fetch('',[
            'categorys'=>$categorys,
        ]);
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
        $data = $request->post();
        $validate = validate('Category');
        if (!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
        }

        $res = $this->obj->add($data);
        //echo $res;
        if ($res){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }
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
        if (intval($id)<1){
            $this->error('参数不合法');
        }
        //get():父类中的方法，$id必须是表的主键ID
        $category = $this->obj->get($id);
        $categorys = $this->obj->getNormalFirstCategory();
        return $this->fetch('',[
            'categorys'=>$categorys,
            'category'=>$category,
        ]);
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
        $data = $request->post();
        //var_dump($data);
        $validate = validate('Category');
        if (!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->obj->save($data,['id'=>intval($data['id'])]);
        //echo $res;
        if ($res){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id,$status)
    {
        //
        $data =[
            'id'=>intval($id),
            'status'=>intval($status),
        ];
        $validate = validate('Category');
        if (!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->obj->save(['status'=>$data['status']],['id'=>intval($data['id'])]);
        //echo $res;
        if ($res){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }
    /**
     * 对队列排序
     * @param  int  $id
     * @param  int  $listorder
     * @return $res
     */
    public function listorder($id,$listorder){
        $res = $this->obj->save(['listorder'=>$listorder],['id'=>$id]);
        if ($res){
            //tp5自带的返回一个JSON格式的数据
            $this->result($_SERVER['HTTP_REFERER'],1,'success');
        }else{
            $this->result($_SERVER['HTTP_REFERER'],0,'error');
        }
    }
}
