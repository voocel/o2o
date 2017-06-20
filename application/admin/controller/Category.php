<?php
namespace app\admin\controller;
use think\Controller;

class Category extends Controller
{
    //显示分类列表
    public function index()
    {
        $parentId = input('get.parent_id',0,'intval');
        $categorys = model('Category')->getFirstCategory($parentId);
        return $this->fetch('',[
            'categorys' => $categorys,
        ]);
    }

    //显示分类添加页面
    public function add()
    {
        $categorys = model('Category')->getNormalFirstCategory();
        return $this->fetch('',[
            'categorys' => $categorys,
        ]);
    }

   //添加分类
    public function save(){
        // print_r(input('post.'));
        if(!request()->isPost()){
            $this->error('请求方式不合法!');
        }
        $data = request()->post();
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        //如果有id传来代表是更新编辑分类操作
        if(!empty($data['id'])){
          $arr = model('Category')->myupdate($data);
          if($arr){
           $this->success('更新成功!');
       }else{
           $this->error('更新失败!');
       }
        }

        $res = model('Category')->add($data);
        if($res){
            $this->success('添加成功');
        }else{
            $this->error('添加失败');
        }

    }

    public function edit($id=0){
        if(intval($id)<1){
            $this->error('参数不合法');
        }
        $category = model('Category')->get($id);
        // var_dump($category->name);exit();
        $categorys = model('Category')->getNormalFirstCategory();
        return $this->fetch('',[
            'categorys' => $categorys,
            'category'  => $category,
        ]);
        
    }

    public function listorder($id,$listorder){
        $res = model('Category')->save(['listorder'=>$listorder],['id'=>$id]);
        if($res){
            $this->result($_SERVER['HTTP_REFERER'],200,'ok');
        }else{
            $this->result($_SERVER['HTTP_REFERER'],400,'fail');
        }
    }
    
    //修改状态
    public function status(){
        $data = request()->get();
        $validate = validate('Category');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $res = $categorys = model('Category')->save(['status'=>$data['status']],['id'=>$data['id']]);
        if($res){
            $this->success('状态更新成功!');
        }else{
            $this->error('状态更新失败!');
        }
    }





}