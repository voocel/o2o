<?php
namespace app\api\controller;

use think\Controller;
use think\Db;

class Category extends Controller
{
    public function getCategorysByParentId()
    {
        $id = input('post.id');
        //获取二级分类

        $category = model('Category')->getNormalCategorysByParentId($id);
        if (!$category) {
            return show(400, 'fail');
        }
        return show(200, 'success', $category);
    }
}
