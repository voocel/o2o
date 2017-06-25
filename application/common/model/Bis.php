<?php
namespace app\common\model;
use think\Model;

class Bis extends BaseModel{
    //通过状态获取商家数据
    public function getBisByStatus($status=0){
        $where = array(
            'status'   => $status,
        );

        $order = array(
            'id'       => 'desc',
        );

        return $this->where($where)->order($order)->paginate(2);
    }


}