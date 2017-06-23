<?php
/**
 *百度地图
 */

 class Map{
      /**
        *根据地址获取经纬度
        */
     public static function getLngLat($address){
        //http://api.map.baidu.com/geocoder/v2/?callback=renderOption&output=json&address=百度大厦&city=北京市&ak=您的ak
        if(!$address){
            return '';
        }
        $data = [
            'address'  => $address,
            'ak'       => config('map.ak'),
            'output'   => 'json',

        ];
        
        $url = config('map.baidu_map_url').config('map.geocoder').'?'.http_build_query($data);
        //获取url的方法:
        //1.file_get_contents($url);
        //2.curl
        $res=toCurl($url);
        if($res){
            return json_decode($res,true);
        }else{
            return [];
        }
        
     }

     /**
      *根据地址或经纬度获取百度地图
      */
     //http://api.map.baidu.com/staticimage/v2
     public static function staticimage($center){
         if(!$center){
             return'';
         }
        $data = [
            'ak'       => config('map.ak'),
            'width'    => config('map.width'),
            'height'   => config('map.height'),
            'center'   => $center,
            'markers'  =>$center,

        ];
        
        $url = config('map.baidu_map_url').config('map.staticimage').'?'.http_build_query($data);
        $res=toCurl($url);
        return $res;

     }
 }