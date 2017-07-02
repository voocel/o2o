<?php
namespace app\common\model;
use think\Model;

class BisLocation extends BaseModel{

        //通过状态获取商家数据
    public function getBisLocationByStatus($status=0){
        $where = array(
            'status'   => $status,
        );

        $order = array(
            'id'       => 'desc',
        );

        return $this->where($where)->order($order)->paginate(2);
    }

    public function getNormalLocationByBisId($bisId){
        $where = array(
            'bis_id'  => $bisId,
            'status'  => 1
        );

        $order = array(
            'id'   => 'desc',   
        );

       $res = $this->where($where)->order($order)->select();
       return $res;
    }


}