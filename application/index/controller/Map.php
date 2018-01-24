<?php
namespace app\index\controller;

use think\Controller;

class Map extends Controller
{
    public function getMapImage($data)
    {
        return \Map::staticimage($data);
    }
}
