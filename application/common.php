<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
//type为0是get为1是post
function toCurl($url,$type=0,$data=[]){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); //只返回结果，不输出
    curl_setopt($ch,CURLOPT_HEADER,0);   //0表示不输出header头

    if($type == 1){
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);        
    }
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

//商户入住申请状态
function bisRegister($status){
       if($status == 1){
           $str = "入入驻申请成功!";
       }elseif($status==0){
           $str = "审核中";
       }elseif($status==2){
           $str = "不符合申请条件，请重新提交!";
       }else{
           $str="该申请已删除!";
       }
       return $str;
}

//分页样式
function pagination($obj){
    if(empty($obj)){
        return '';
    }
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 o2o-page">'.$obj->render().'</div>';
}

function getSeCityName($path){
    if(empty($path)){
        return '';
    }
    
    if(preg_match("/,/",$path)){
        $cityPath = explode(',',$path);
        $cityId = $cityPath[1];
        
    }else{
        $cityId = $path;
    }
    $city = model('City')->get($cityId);
    return $city->name;
}



}