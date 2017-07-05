<?php
namespace app\common\model;
use think\Model;

class Featured extends BaseModel{

    public function getFeaturedsByType($type){
        $where = array(
            'status'  => ['neq',-1],
            'type'    => $type
        );
        $order = ['id'=>'desc'];

        $res = $this->where($where)->order($order)->paginate();
        return $res;
    }


}