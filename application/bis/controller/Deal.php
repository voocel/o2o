<?php
namespace app\bis\controller;
use think\Controller;
class Deal extends Base
{
    public function index()
    {
        return $this->fetch();
    }

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
                'city_id'    => $data['city_id'],
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
