<?php
namespace app\index\controller;
use think\Controller;
class Index extends Base
{
    public function index()
    {
        $slideshows = model('featured')->getFeaturedsByType(0);
        $slidepic = model("featured")->where(['status'=>['neq',-1],'type'=>1])->order(["id"=>'desc'])->find();
        
        return $this->fetch('',['slideshows'=>$slideshows,"slidepic"=>$slidepic]);
    }
}
