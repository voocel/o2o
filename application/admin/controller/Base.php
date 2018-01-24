<?php
namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    public function status()
    {
        $data = input('get.');
        //TODO 验证
        if (empty($data['id'])) {
            $this->error("id不合法!");
        }
        if (!is_numeric($data['status'])) {
            $this->error("status不合法!");
        }
        //获取控制器，而控制器名对应着model名
        $model = request()->controller();
        $res = model($model)->save(['status'=>$data['status']], ['id'=>$data['id']]);
        if ($res) {
            $this->success("更新状态成功!");
        } else {
            $this->error("更新状态失败!");
        }
    }
}
