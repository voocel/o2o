<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public $city = '';
    public $account = '';

    public function _initialize()
    {
        //获取城市
        $citys = model('city')->getNormalCitys();
        $this->getCity($citys);
        //获取首页分类信息
        $cats = $this->getRecommendCats();
        $this->assign('cats',$cats);
        $this->assign('citys',$citys);
        $this->assign('city',$this->city);
        $this->assign('user',$this->getLoginUser());   //用户信息
        //根据不同页面传递不同的css
        $this->assign('controller',strtolower(request()->controller()));
        $this->assign('title','团购首页');
        
    }

    public function getCity($citys){
        foreach($citys as $city){
            $city = $city->toArray();
            if($city['is_default']==1){
                $defaultuname = $city['uname'];
                break;       //找到默认城市，则终止循环
            }
        }
            $defaultuname = $defaultuname ??'beijing';
            if(session('cityuname','','o2o') && !input('get.city') ){
                $cityuname = session("cityuname",'','o2o');
            }else{
                $cityuname = input('get.city',$defaultuname,'trim');
                session("cityuname",$cityuname,'o2o');
            }
            $this->city = model('city')->where(['uname'=>$cityuname])->find();
    }

    public function getLoginUser(){
        if(!$this->account){
            $this->account = session('o2o_user','','o2o');
        }
            return $this->account;
    }

    //获取首页推荐商品分类信息
    public function getRecommendCats(){
       $parentIds=$sedcatArr=$recomCats = [];
       $cats = model("category")->getNormalRecommendCategoryByParentId(0,5);
       //获取一级分类id
       foreach($cats as $cat){
           $parentIds[] = $cat->id;
       }
       //获取二级分类数据
       $sedCats = model("category")->getNormalCategoryIdParentId($parentIds);
       foreach($sedCats as $sedcat){
           $sedcatArr[$sedcat->parent_id][] = array(
               'id'   => $sedcat->id,
               'name' => $sedcat->name
           );
       }
       foreach($cats as $cat){
//recomCats为一级和二级分类的所有数据，第一个参数是一级分类的name，第二个参数是该一级分类下的所有二级分类数据
           $recomCats[$cat->id] = [
               $cat->name,empty($sedcatArr[$cat->id])?[]:$sedcatArr[$cat->id]
           ];
       }
       return $recomCats;
    }

}