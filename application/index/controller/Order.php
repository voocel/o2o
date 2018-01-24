<?php
namespace app\index\controller;

use think\Controller;

class Order extends Base
{
    public function index()
    {
        $user = $this->getLoginUser();
        if (!$user) {
            $this->error("请登录!", 'user/login');
        }
        $id = input('get.id', 0, 'intval');
        if (!$id) {
            $this->error("参数不合法!");
        }
        $dealCount = input('get.deal_count', 0, 'intval');
        $totalPrice = input('get.total_price', 0, 'intval');
        $deal = model('deal')->find($id);
        if (!$deal || $deal->status!=1) {
            $this->error("商品不存在!");
        }
        if (empty($_SERVER['HTTP_REFERER'])) {
            $this->error("请求不合法!");
        }
        //入库
        $orderSn = setOrderSn();    //获取订单号
        $data = array(
            'out_trade_no'   => $orderSn,
            'user_id'        => $user->id,
            'username'       => $user->username,
            'deal_id'        => $deal->id,
            'deal_count'     => $dealCount,
            'total_price'    => $totalPrice,
            'referer'        => $_SERVER['HTTP_REFERER'],
        );
        //数据库插入更新等一般都需要try catch处理
        try {
            $orderId = model('order')->add($data);
        } catch (\Exception $e) {
            $this->error("订单处理失败!");
        }
       
        $this->redirect(url('pay/index', ['id'=>$orderId]));
    }


    public function confirm()
    {
        if (!$this->getLoginUser()) {
            $this->error("请登录!", 'user/login');
        }
        $id = input('get.id', 0, 'intval');
        if (!$id) {
            $this->error("参数不合法!");
        }
        $count = input('get.count', 1, 'intval');
        $deal = model('deal')->find($id);
        //echo model('deal')->find($id)->getLastSql();exit;
        if (!$deal || $deal->status!=1) {
            $this->error("商品不存在!");
        }
        $deal = $deal->toArray();
       
        return $this->fetch('', [
            'deal'     => $deal,
            'count'    => $count,
        ]);
    }
}
