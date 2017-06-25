<?php
namespace app\bis\controller;
use think\Controller;
class Register extends Controller
{
    public function index(){
       $city = model('City')->getNormalCitysByParentId($parentId=0);
       $category = model('Category')->getNormalCategorysByParentId($parentId=0);

       return $this->fetch('',['city'=>$city,'category'=>$category]);
    }

    public function add(){
        if(!request()->isPost()){
            $this->error('请求方式不合法!');
        }
        $data = input('post.');
        $validate = validate('Bis');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        
        //获取经纬度
        $lnglat = \Map::getLngLat($data['address']);
        if(empty($lnglat)||$lnglat['status']!==0||$lnglat['result']['precise']!=1){
            $this->error('无法获取数据，或匹配地址不精确!');
        }
       
       //检测用户名是否已存在
      $account = model('bis_account')->get(['username'=>$data['username']]);
      if($account){
          $this->error("该账户已经存在!");
      }

       //商户基本信息入库
       $bisData=array(
           'name'   => $data['name'],
           'email'  => $data['email'],
           'logo'   => $data['logo'],
           'licence_logo' =>$data['licence_logo'],
           'city_id'=> $data['city_id'],
           'city_path' => empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
           'bank_info' => $data['bank_info'],
           'bank_name' => $data['bank_name'],
           'bank_user' => $data['bank_user'],
           'faren'     => $data['faren'],
           'faren_tel' => $data['faren_tel'],
           'description' => $data['description'],
       );
       $bisId=model('Bis')->add($bisData);

     //总店信息入库  
     $data['cat'] = '';
       if(!empty($data['se_category_id'])){
           $data['cat'] = implode('|',$data['se_category_id']);
       }
       $locationData = array(
           'bis_id'        => $bisId,
           'name'          => $data['name'],
           'logo'          => $data['logo'],
           'tel'           => $data['tel'],
           'contact'       => $data['contact'],
           'category_id'   => $data['category_id'],
           'category_path' => empty($data['se_category_id'])?$data['category_id']:$data['category_id'].','.$data['cat'],
           'city_id'       => $data['city_id'],
           'city_path'     => empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
           'api_address'       => $data['address'],
           'open_time'     => $data['open_time'],
           'content'       => empty($data['content'])? '':$data['content'],
           'is_main'       => 1, //代表总店信息,因为可能有分店
           'xpoint'        => empty($lnglat['result']['location']['lng'])? '' :$lnglat['result']['location']['lng'],
           'ypoint'        => empty($lnglat['result']['location']['lat'])? '' :$lnglat['result']['location']['lat'],
       );
       $locationId = model('BisLocation')->add($locationData);

       //账户信息入库
       //自动生成密码加盐字符串
       $data['code'] = mt_rand(100,10000);
       $accountData = array(
           'bis_id'        => $bisId,
           'username'      => $data['username'],
           'code'          => $data['code'],
           'password'      => md5($data['password'].$data['code']),
           'is_main'       => 1, //代表总管理员
       );
       $accountId=model('BisAccount')->add($accountData);
       if(!$accountId){
           $this->error('创建失败!');
       }
       //发送邮件
       $url = request()->domain().url('bis/register/waiting',['id'=>$bisId]);
       $title = "入驻申请通知!";
       $content = "您申请的入驻申请需等待平台审核，您可通过点击链接<a href='".$url."' target='_blank'>查看链接</a> 查看状态";
       \phpmailer\Email::send($data['email'],$title,$content);
       $this->success('申请成功!',url('bis/register/waiting',['id'=>$bisId]));



        //总店信息验证
        //账户信息验证
    }

    public function waiting($id){
        if(empty($id)){
            $this->error('id不能为空!');
        }
        $detail = model('Bis')->get($id);

        return $this->fetch('',['detail'=>$detail]);
    }
}