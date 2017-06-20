<?php
namespace app\admin\validate;
use think\Validate;

class Category extends Validate{
    protected $rule=[
          ['name','require|max:10','分类名不能为空|长度不能超过10个字'],
          ['parent_id','number','必须为整数'],
          ['id','number','id必须为整数'],
          ['status','number|in:-1,0,1','状态必须是数字|状态范围不合法'],
          ['listorder','number'],
    ];

    // 场景设置
    protected $scene = [
        'add'        =>['name','parent_id','id'],      //(add为调用时使用的参数标记,只验证这两个字段)添加分类验证
        'listorder'  =>['id','listorder'],      //排序验证
        'status'     =>['id','status'],
    ];
}