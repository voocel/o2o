<?php
namespace app\common\model;

use think\Model;

class Deal extends BaseModel
{
    public function getNormalDeals($data=[])
    {
        $data['status'] = 1;
        $order = array(
            'id' => 'desc',
        );
        $res = $this->where($data)->order($order)->paginate();
        //echo $this->getLastSql();
        return $res;
    }

    //通过状态获取团购数据
    public function getDealByStatus($status=0)
    {
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
    public function getNormalDealByCategoryCityId($id, $cityId, $limit=10)
    {
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

    public function getDealByConditions($where=[], $orders)
    {
        if (!empty($orders['order_salse'])) {
            $order['buy_count'] = 'desc';
        }
        if (!empty($orders['order_price'])) {
            $order['current_price'] = 'desc';
        }
        if (!empty($orders['order_time'])) {
            $order['create_time'] = 'desc';
        }
        $order['id'] = 'desc';
        $wheres[] = 'end_time>'.time();
        if (!empty($where['se_category_id'])) {
            $wheres[] = " find_in_set(".$where['se_category_id'].",se_category_id)";
        }
        if (!empty($where['category_id'])) {
            $wheres[] = 'category_id='.$where['category_id'];
        }
        if (!empty($where['city_id'])) {
            $wheres[] = 'city_id='.$where['city_id'];
        }
        $wheres[] = 'status=1';
        $res = $this->where(implode(' AND ', $wheres))->order($order)->paginate(3);
        // echo $this->getLastSql();exit;
        return $res;
    }
}
