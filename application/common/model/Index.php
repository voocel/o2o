<?php
namespace app\bis\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function welcome(){
        return $this->fetch();
    }
}
