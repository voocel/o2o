<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use Map;

class Featured extends Base
{
    public function index()
    {
        $types = config('featured.featured_type');
        $type = input('get.type', 0, 'intval');
        $featureds = model('featured')->getFeaturedsByType($type);
        return $this->fetch('', [
                 'type' => $type,
                 'types'=> $types,
                 'featureds' => $featureds
                 ]);
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            //TODO 验证
            $id = model('featured')->add($data);
            if ($id) {
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        } else {
            //获取推荐位类别
            $types = config('featured.featured_type');
            return $this->fetch('', [
            'types'  => $types,
        ]);
        }
    }

    /* 可通过base类继承直接使用
        public function status(){
            $data = input('get.');
            //TODO 验证
            $res = model('featured')->save(['status'=>$data['status']],['id'=>$data['id']]);
            if($res){
                $this->success("更新状态成功!");
            }else{
                $this->error("更新状态失败!");
            }
        }
        */
}
