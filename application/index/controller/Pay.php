<?php
namespace app\index\controller;

use think\Controller;

class Pay extends Base
{
    public function index()
    {
        return "订单生成成功,等待支付!";
    }
}
