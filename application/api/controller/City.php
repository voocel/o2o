<?php
namespace app\api\controller;
use think\Controller;
use think\Db;

class City extends Controller{
    public function getCitysByParentId(){
        $id = input('post.id');
        //获取二级城市
        $city = model('City')->getNormalCitysByParentId($id);
        if(!$city){
            return show(400,'fail');
        }
        return show(200,'success',$city);

    }
}