<?php
namespace app\api\controller;

use think\Controller;
use think\Request;
use think\File;

class Image extends Controller
{
    public function upload()
    {
        $file = Request::instance()->file('file');
        //$file = request()->file('file');
        //图片上传目录
        $info = $file->move('upload');
   
        return show(201, 'ok', '/'.$info->getPathname());
    }
}
