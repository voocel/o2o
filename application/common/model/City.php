<?php

namespace app\common\model;

use think\Model;

class City extends Model
{
    public function getNormalCitysByParentId($parentId){
        $where = [
            'status'  => 1,
            'parent_id' => $parentId,
        ];
        $order = [
            'id'   => 'desc',
        ];

       return $this->where($where)->order($order)->select();
    }
    
    //获取市
    public function getNormalCitys(){
        $where = array(
            'status'    => 1,
            'parent_id' => ['gt',0]
        );
        $order = array(
            'id'   =>'desc',
        );

      return  $this->where($where)->order($order)->select();
    }
}
