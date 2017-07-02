<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use Map;
class Deal extends Controller
{
    //显示分类列表
    public function index()
    {
        $data = input('get.');
        $sdata = [];
        if(!empty($data['category_id'])){
            $sdata['category_id'] = $data['category_id'];
        }
        if(!empty($data['city_id'])){
            $sdata['city_id'] = $data['city_id'];
        }
        if(!empty($data['start_time'])&&!empty($data['end_time'])&&strtotime($data['end_time'])>strtotime($data['start_time'])){
            $sdata['create_time']=array(
                ['gt',strtotime($data['start_time'])],
                ['lt',strtotime($data['end_time'])]
            );
        }
        if(!empty($data['name'])){
            $sdata['name'] = ['like','%'.$data['name'].'%'];
        }
        $deals = model('deal')->getNormalDeals($sdata);
        
        $categorys = model('category')->getNormalCategorysByParentId($parentId=0);
        $citys = model('city')->getNormalCitys();
        return $this->fetch('',[
           'citys'   => $citys,
           'categorys' => $categorys,
           'deals'    => $deals
        ]);
        
    }
    
   

}