<?php
namespace app\index\controller;
use think\Controller;
class Order extends Base
{
    public function confirm()
    {
        if(!$this->getLoginUser()){
            $this->error("请登录!",'user/login');
        }
        $id = input('get.id',0,'intval');
        if(!$id){
            $this->error("参数不合法!");
        }
        $count = input('get.count',1,'intval');
        $deal = model('deal')->find($id);
        //echo model('deal')->find($id)->getLastSql();exit;
        if(!$deal || $deal->status!=1){
            $this->error("商品不存在!");
        }
        $deal = $deal->toArray();
       
        return $this->fetch('',[
            'deal'     => $deal,
            'count'    => $count,
        ]);
    }
}
