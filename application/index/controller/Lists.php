<?php
namespace app\index\controller;
use think\Controller;
class Lists extends Base
{
    public function index()
    {
        $firstCateIds = [];
        //获取一级分类
        $categorys = model('category')->getNormalCategorysByParentId(0);
        foreach($categorys as $category){
            $firstCateIds[] = $category->id;
        }
        $id = input('id',0,'intval');
        $where = [];
        //id为0，一级分类，二级分类
        if(in_array($id,$firstCateIds)){   //一级分类
            $categoryParentId = $id;
            $where['category_id'] = $id;
        }elseif($id){  //二级分类
            //获取二级分类数据
            $category = model('category')->get($id);
            if(!$category||$category->status!==1){
                $this->error("数据不合法!");
            }
            $categoryParentId = $category->parent_id;
            $where['se_category_id'] = $id;
        }else{
            $categoryParentId = 0;
        }
        //获取父类下的所有子分类
        $sedcategorys = [];
        if($categoryParentId){
            $sedcategorys = model('category')->getNormalCategorysByParentId($categoryParentId);
        }
        $order = '';
        //排序处理
        $order_sales = input('order_sales','');
        $order_price = input('order_price','');
        $order_time = input('order_time','');
        if(!empty($order_sales)){
            $orderflag = 'order_sales';
            $orders['order_sales'] = $order_sales;
        }elseif (!empty($order_price)){
            $orderflag = 'order_price';
            $orders['order_price'] = $order_price;
        }elseif (!empty($order_time)) {
            $orderflag = 'order_time';
            $orders['order_time'] = $order_time;
        }else{
            $orderflag = '';
        }
        $deals = model('deal')->getDealByConditions($where,$order);
        return $this->fetch('',[
            'categorys'  => $categorys,
            'id'         => $id,
            'categoryParentId'  => $categoryParentId,
            'sedcategorys'   => $sedcategorys,
            'orderflag'   => $orderflag,
            'deals'       => $deals,
        ]);
    }
}
