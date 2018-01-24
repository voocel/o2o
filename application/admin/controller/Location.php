<?php
namespace app\admin\controller;

use think\Controller;

class Location extends Controller
{
    //审核通过的门店列表
    public function index()
    {
        $location = model('BisLocation')->getLocationByStatus(1);
        return $this->fetch('', ['location'=>$location]);
    }
    //门店申请列表
    public function apply()
    {
        $location = model('BisLocation')->getLocationByStatus();
        return $this->fetch('', ['location'=>$location]);
    }

    public function detail()
    {
        $id = input('get.id');
        //echo $id;exit();
        if (empty($id)) {
            $this->error('id不存在!');
        }
        //获取一级城市数据
        $city = model('City')->getNormalCitysByParentId($parentId=0);
        //获取一级分类数据
        $category = model('Category')->getNormalCategorysByParentId($parentId=0);
        //获取商户数据
        $locationData = model('BisLocation')->get(['id'=>$id,'is_main'=>0]);
        return $this->fetch('', [
                    'city'=>$city,
                    'category'=>$category,
                    'locationData' => $locationData,
                ]);
    }

    //修改状态
    public function status()
    {
        $data = request()->get();
        // $validate = validate('Bis');
        // if(!$validate->scene('status')->check($data)){
        //     $this->error($validate->getError());
        // }

        $location = model('BisLocation')->save(['status'=>$data['status']], ['id'=>$data['id'],'is_main'=>0]);

        if ($location) {
            //发送邮件通知
            //status 1=>审核通过, 2=>不通过, -1=>删除
            $this->success('状态更新成功!');
        } else {
            $this->error('状态更新失败!');
        }
    }

    public function delist()
    {
        return $this->fetch();
    }
}
