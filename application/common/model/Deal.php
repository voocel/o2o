<?php
namespace app\common\model;
use think\Model;

class Deal extends BaseModel{
    public function getNormalDeals($data=[]){
        $data['status'] = 1;
        $order = array(
            'id' => 'desc',
        );
      $res = $this->where($data)->order($order)->paginate();
      //echo $this->getLastSql();
      return $res;
    }

        //通过状态获取团购数据
    public function getDealByStatus($status=0){
        $where = array(
            'status'   => $status,
        );

        $order = array(
            'id'       => 'desc',
        );

        return $this->where($where)->order($order)->paginate(2);
    }


}