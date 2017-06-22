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
}
