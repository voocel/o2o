<?php
namespace app\bis\controller;

use think\Controller;

class Location extends Base
{
    /**
    *门店列表页
    */
    public function index()
    {
        $bis = model('bisLocation')->getBisLocationByStatus(1);
        return $this->fetch('', ['bis'=>$bis]);
    }

    /**
    *门店添加
    */
    public function add()
    {
        //TODO数据验证
        if (request()->isPost()) {
            //总店信息入库
            $data=input('post.');
            $bisId=$this->getLoginUser()->bis_id;

            $data['cat'] = '';
            if (!empty($data['se_category_id'])) {
                $data['cat'] = implode('|', $data['se_category_id']);
            }

            //获取经纬度
            $lnglat = \Map::getLngLat($data['address']);
            if (empty($lnglat)||$lnglat['status']!==0||$lnglat['result']['precise']!=1) {
                $this->error('无法获取数据，或匹配地址不精确!');
            }

            $locationData = array(
           'bis_id'        => $bisId,
           'name'          => $data['name'],
           'logo'          => $data['logo'],
           'tel'           => $data['tel'],
           'contact'       => $data['contact'],
           'category_id'   => $data['category_id'],
           'category_path' => empty($data['se_category_id'])?$data['category_id']:$data['category_id'].','.$data['cat'],
           'city_id'       => $data['city_id'],
           'city_path'     => empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
           'api_address'       => $data['address'],
           'open_time'     => $data['open_time'],
           'content'       => empty($data['content'])? '':$data['content'],
           'is_main'       => 0, //代表总店信息,因为可能有分店
           'xpoint'        => empty($lnglat['result']['location']['lng'])? '' :$lnglat['result']['location']['lng'],
           'ypoint'        => empty($lnglat['result']['location']['lat'])? '' :$lnglat['result']['location']['lat'],
       );
            $locationId = model('BisLocation')->add($locationData);
            if ($locationId) {
                return $this->success("门店申请成功!");
            } else {
                return $this->error("门店申请失败!");
            }
        } else {
            $city = model('City')->getNormalCitysByParentId($parentId=0);
            $category = model('Category')->getNormalCategorysByParentId($parentId=0);

            return $this->fetch('', ['city'=>$city,'category'=>$category]);
            return $this->fetch();
        }
    }
}
