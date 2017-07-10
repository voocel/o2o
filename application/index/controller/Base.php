<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public function _initialize()
    {
        $citys = model('city')->getNormalCitys();

        $this->assign('citys',$citys);
        
    }
}
