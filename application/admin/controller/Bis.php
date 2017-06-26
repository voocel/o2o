<?php
namespace app\admin\controller;
use think\Controller;

class Bis extends Controller
{
    //审核通过的商户列表
    public function index(){
        $bis = model('Bis')->getBisByStatus(1);
        return $this->fetch('',['bis'=>$bis]);
    }
    //入驻申请列表
    public function apply()
    {
        $bis = model('Bis')->getBisByStatus();
        return $this->fetch('',['bis'=>$bis]);
    }

    public function detail(){
       $id = input('get.id');
       //echo $id;exit();
       if(empty($id)){
           $this->error('id不存在!');
       }
       //获取一级城市数据
       $city = model('City')->getNormalCitysByParentId($parentId=0);
       //获取一级分类数据
       $category = model('Category')->getNormalCategorysByParentId($parentId=0);
       //获取商户数据
       $bisData = model('Bis')->get($id);
       //var_dump($bisData);exit();
       $locationData = model('BisLocation')->get(['bis_id'=>$id,'is_main'=>1]);
       $accountData = model('BisAccount')->get(['bis_id'=>$id,'is_main'=>1]);
       return $this->fetch('',[
                    'city'=>$city,
                    'category'=>$category,
                    'bisData' => $bisData,
                    'locationData' => $locationData,
                    'accountData'  => $accountData,
                ]);        
    }

        //修改状态
    public function status(){
        $data = request()->get();
        // $validate = validate('Bis');
        // if(!$validate->scene('status')->check($data)){
        //     $this->error($validate->getError());
        // }
        $res = model('Bis')->save(['status'=>$data['status']],['id'=>$data['id']]);
        $location = model('BisLocation')->save(['status'=>$data['status']],['id'=>$data['id'],'is_main'=>1]);
        $account = model('BisAccount')->save(['status'=>$data['status']],['id'=>$data['id'],'is_main'=>1]);
        if($res&&$location&&$account){
            //发送邮件通知
            //status 1=>审核通过, 2=>不通过, -1=>删除
            $this->success('状态更新成功!');
        }else{
            $this->error('状态更新失败!');
        }
    }

}
