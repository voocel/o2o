<?php
namespace app\bis\controller;
use think\Controller;
class Register extends Controller
{
    public function index(){
       $city = model('City')->getNormalCitysByParentId($parentId=0);
    //    foreach($city as $value){
    //        print_r($value['name']);
    //    }
       //var_dump($city->name);
       return $this->fetch('',['city'=>$city]);
    }
}