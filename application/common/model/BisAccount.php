<?php
namespace app\common\model;
use think\Model;

class BisAccount extends BaseModel{

    public function updateById($data,$id){
        return $this->allowField(true)->save($data,['id'=>$id]);
    }

}