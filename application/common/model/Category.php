<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = true;
    public function add($data){
        $data['status'] = 1;
        // $data['create_time'] = time();
        return $this->save($data);
    }

    public function getNormalFirstCategory(){
        $where = [
            'status'    => 1,
            'parent_id' =>0,
        ];
        $order = ['id' => 'desc'];
        return $this->where($where)->order($order)->select();
    }

    //分类列表展示一级栏目
    public function getFirstCategory($parentId=0){
        $where = [
            'parent_id'   => $parentId,
            'status'      => ['neq',-1],
        ];
        $order = ['id' => 'desc'];
        $res = $this->where($where)->order($order)->paginate();
        // echo $this->getLastSql();
        return $res;
    }
}