<?php
namespace app\admin\controller;

use think\Controller;
use phpmailer\Email;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function welcome()
    {
        // Email::send('voocel@163.com','标题','内容');
        // return '发送邮件成功!';
        return $this->fetch();
    }
}
