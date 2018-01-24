<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use Map;

class Deal extends Controller
{
    //显示团购列表
    public function index()
    {
        $data = input('get.');
        $sdata = [];
        if (!empty($data['start_time'])&&!empty($data['end_time'])&&strtotime($data['end_time'])>strtotime($data['start_time'])) {
            $sdata['create_time']=array(
                ['gt',strtotime($data['start_time'])],
                ['lt',strtotime($data['end_time'])]
            );
        }
        if (!empty($data['category_id'])) {
            $sdata['category_id'] = $data['category_id'];
        }
        if (!empty($data['city_id'])) {
            $sdata['city_id'] = $data['city_id'];
        }
        
        if (!empty($data['name'])) {
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

        return $this->fetch('', [
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

    //团购申请列表
    public function apply()
    {
        $deal = model('Deal')->getDealByStatus();

        $categorys = model('category')->getNormalCategorysByParentId($parentId=0);
        $citys = model('city')->getNormalCitys();
        $cityArrs = $categoryArrs = [];
        foreach ($categorys as $category) {
            $categoryArrs[$category->id] = $category->name;
        }
        foreach ($citys as $city) {
            $cityArrs[$city->id] = $city->name;
        }
        return $this->fetch('', ['deal'=>$deal,'categoryArrs'  => $categoryArrs,'cityArrs' => $cityArrs,]);
    }

    //修改状态
    public function status()
    {
        $data = request()->get();
        // $validate = validate('Bis');
        // if(!$validate->scene('status')->check($data)){
        //     $this->error($validate->getError());
        // }
        $deal = model('Deal')->save(['status'=>$data['status']], ['id'=>$data['id']]);

        if ($deal) {
            //发送邮件通知
            //status 1=>审核通过, 2=>不通过, -1=>删除
            $this->success('状态更新成功!');
        } else {
            $this->error('状态更新失败!');
        }
    }
}
