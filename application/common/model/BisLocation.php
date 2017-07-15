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

        return $this->where($where)->order($order)->paginate(10);
    }
    
    //当前商户下的门店
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

    //获取所有审核通过的的门店
    public function getLocationByStatus($status=0){
        $where = array(
            'status'   => $status,
            'is_main'  => 0
        );
        $order = array(
            'id'  => 'desc',
        );

        $res = $this->where($where)->order($order)->paginate(10);
        return $res;

    }

    public function getNormalLocationInId($ids){
        $where = array(
            'id'      => ['in',$ids],
            'status'  => 1,
        );
        return $this->where($where)->select();

    }


}