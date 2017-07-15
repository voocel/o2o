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
    
    /**
     *根据分类和城市获取商品数据
     */
    public function getNormalDealByCategoryCityId($id,$cityId,$limit=10){
        $where = array(
            'end_time'     => ['gt',time()],
            'category_id'  => $id,
            'city_id'      => $cityId,
            'status'       => 1
        );
        $order = ['listorder'=>'desc','id'=>'desc'];
        $res = $this->where($where)->order($order)->limit($limit)->select();
        return $res;
    }


}