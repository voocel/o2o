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
      echo $this->getLastSql();
      return $res;
    }


}