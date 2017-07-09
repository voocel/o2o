<?php
namespace app\index\controller;
use think\Controller;
class User extends Controller
{
    public function login()
    {
        return $this->fetch();
    }

    public function register(){
        return $this->fetch();
    }
}
