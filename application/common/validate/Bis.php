<?php
namespace app\common\validate;
use think\Validate;

class Bis extends Validate{
    protected $rule = [
        'name'      => 'require|max:25',
        'email'     => 'require|email',
        'logo'      => 'require',
        'licence_logo'=> 'require',
        'city_id'   => 'require',
        'bank_info' => 'require',
        'bank_name' => 'require',
        'bank_user' => 'require',
        'faren'     => 'require',
        'faren_tel' => 'require',

    ];

    protected $scene = array(
        'add'       => ['name','email','city_id','logo','bank_info','bank_name','bank_user','faren','faren_tel'],
    );


}