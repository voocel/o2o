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
        $data = request()->post();
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
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




}