<?php
namespace app\common\model;

use think\Model;

class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;

    public function add($data)
    {
        $data['status'] = 0;
        $this->save($data);
        return $this->id;
    }
    
    //根据id更新
    public function updateById($data, $id)
    {
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
}
