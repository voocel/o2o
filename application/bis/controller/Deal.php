<?php
namespace app\bis\controller;
use think\Controller;
class Deal extends Base
{
    //团购列表
    public function index()
    {
        $data = input('get.');
        $sdata = [];
        if(!empty($data['start_time'])&&!empty($data['end_time'])&&strtotime($data['end_time'])>strtotime($data['start_time'])){
            $sdata['create_time']=array(
                ['gt',strtotime($data['start_time'])],
                ['lt',strtotime($data['end_time'])]
            );
        }
        if(!empty($data['category_id'])){
            $sdata['category_id'] = $data['category_id'];
        }
        if(!empty($data['city_id'])){
            $sdata['city_id'] = $data['city_id'];
        }
        
        if(!empty($data['name'])){
            $sdata['name'] = ['like','%'.$data['name'].'%'];
        }
        $deals = model('deal')->getNormalDeals($sdata);
        $categorys = model('category')->getNormalCategorysByParentId($parentId=0);
        $citys = model('city')->getNormalCitys();
        $cityArrs = $categoryArrs = [];
        foreach ($categorys as $category) {
            $categoryArrs[$category->id] = $category->name;
        }
        foreach ($citys as $city) {
            $cityArrs[$city->id] = $city->name;
        }

        return $this->fetch('',[
           'citys'   => $citys,
           'categorys' => $categorys,
           'deals'    => $deals,

           'category_id' => empty($data['category_id'])?'':$data['category_id'],
           'city_id'   => empty($data['city_id'])?'':$data['city_id'],
           'name'   => empty($data['name'])?'':$data['name'],
           'start_time' => empty($data['start_time'])?'':$data['start_time'],
           'end_time' => empty($data['end_time'])?'':$data['end_time'],

           'categoryArrs'  => $categoryArrs,
           'cityArrs'      => $cityArrs,
        ]);
    }

    //团购商品添加
    public function add(){
        $bisId = $this->getLoginUser()->bis_id;
        if(request()->isPost()){
            $data=input('post.');
            //TODO验证
            //获取经纬度用
            $location=model('BisLocation')->get($data['location_ids'][0]);
            $deals=array(
                'bis_id'   => $bisId,
                'name'     => $data['name'],
                'image'    => $data['image'],
                'category_id'    => $data['category_id'],
                'se_category_id'    => empty($data['se_category_id'])?'':implode(',',$data['se_category_id']),
                'city_id'    => $data['se_city_id'],
                'location_ids'    => empty($data['location_ids'])?'':implode(',',$data['location_ids']),
                'start_time'    => strtotime($data['start_time']),
                'end_time'    => strtotime($data['end_time']),
                'total_count'    => $data['total_count'],
                'origin_price'    => $data['origin_price'],
                'current_price'    => $data['current_price'],
                'coupons_start_time'    => strtotime($data['coupons_start_time']),
                'coupons_end_time'    => strtotime($data['coupons_end_time']),
                'notes'    => $data['notes'],
                'description'    => $data['description'],
                'bis_account_id'    => $this->getLoginUser()->id,
                'xpoint'    => $location->xpoint,
                'ypoint'    => $location->ypoint,
            );
            
            //入库
            $id=model('deal')->add($deals);
            if($id){
                $this->success("添加成功!",url('deal/index'));
            }else{
                $this->error('添加失败!');
            }

        }
        $city = model('City')->getNormalCitysByParentId($parentId=0);
        $category = model('Category')->getNormalCategorysByParentId($parentId=0);
        return $this->fetch('',['city'=>$city,
                            'category'=>$category,
                            'bislocations' => model('BisLocation')->getNormalLocationByBisId($bisId)
                            ]);
    }
}
