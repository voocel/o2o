<?php
namespace app\index\controller;
use think\Controller;
class User extends Controller
{
    public function login()
    {
        if(request()->isPost()){
           $post = input('post.');
           if(captcha_check($post['verifyCode'])){
               
           }else{
               $this->error("验证码错误，请重新输入!");
           }
                    
        }else{
             return $this->fetch();
        }
    }

    public function register(){
        if(request()->isPost()){
            
        }
        return $this->fetch();
    }
}
