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

    //更新编辑分类
    public function myupdate($data){
       $res = $this->save($data,intval(['id'=>$data['id']]));
       return $res;
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
        $order = [
            'listorder' => 'desc',
            'id' => 'desc'
            ];
        $res = $this->where($where)->order($order)->paginate();
        // echo $this->getLastSql();
        return $res;
    }

//前端api调用
    public function getNormalCategorysByParentId($parentId){
        $where = [
            'status'  => 1,
            'parent_id' => $parentId,
        ];
        $order = [
            'id'   => 'desc',
        ];

       return $this->where($where)->order($order)->paginate();
    }

    public function getNormalRecommendCategoryByParentId($id=0,$limit=5){
        $where = array(
            'status'   => 1,
            'parent_id'=> $id
        );
        $order = array(
            'listorder'  => 'desc',
            'id'         => 'desc'
        );

        $res = $this->where($where)->order($order);
        if($limit){
            $res = $res->limit($limit);
        }
        return $res->select();
    }

    public function getNormalCategoryIdParentId($ids){
        $where = array(
            'parent_id'   => ['in',implode(',',$ids)],
            'status'   => 1,
        );
        $order = array(
            'listorder'  => 'desc',
            'id'         => 'desc'
        );
        $res = $this->where($where)->order($order)->select();
        return $res;
    }



    
}
