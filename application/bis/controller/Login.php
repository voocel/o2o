<?php
namespace app\bis\controller;
use think\Controller;
class Login extends Controller
{
    public function index(){
        if(request()->isPost()){
            $data = input('post.');
            $res = model('BisAccount')->get(['username'=>$data['username']]);
            
            if(!$res||$res->status!==1){
                $this->error('账号不存在，或尚未审核通过!');
            }
            if($res->password !== md5($data['password'].$res->code)){
                $this->error('密码错误!');
            }
            //更新登录时间
            model('BisAccount')->updateById(['last_login_time'=>time()],$res->id);
            //保存信息 bis为作用域
            session('bisAccount',$res,'bis');
            $this->success('登录成功!',url('index/index'));

        }else{
            //获取session
            $account = session('bisAccount','','bis');
            if($account && $account->id){
                return $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }
    }

    public function logout(){
        session(null,'bis');
        $this->redirect(url('login/index'));
    }

}