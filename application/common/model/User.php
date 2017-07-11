<?php
namespace app\common\model;

use think\Model;

class User extends BaseModel
{
    public function add($data=[]){
        if(!is_array($data)){
            exception("传递的数据不是数组!");
        }
        $data['status'] = 1;
        
        return $this->allowField(true)->save($data);
    }

    //根据用户名获取用户信息
    public function getUserByUsername($username){
        if(!$username){
            exception("用户名不合法,不能为空!");
        }
        $where = ['username'=>$username];
        return $this->where($where)->find();
    }

}