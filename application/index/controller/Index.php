<?php
namespace app\index\controller;
use think\Controller;
class Index extends Base
{
    public function index()
    {
        $slideshows = model('featured')->getFeaturedsByType(0);
        $slidepic = model("featured")->where(['status'=>['neq',-1],'type'=>1])->order(["id"=>'desc'])->find();
        
        //根据栏目id和城市id获取商品
        $deals = model("deal")->getNormalDealByCategoryCityId(10,$this->city->id);
        //获取四个子分类
        $foodcate = model('category')->getNormalRecommendCategoryByParentId(10,10);
        return $this->fetch('',[
            'slideshows' => $slideshows,
            "slidepic"   => $slidepic,
            'deals'      => $deals,
            'foodcate'   => $foodcate
            ]);
    }
}
