<?php
namespace app\index\controller;
use think\Controller;
class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}
