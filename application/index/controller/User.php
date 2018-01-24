<?php
namespace app\index\controller;

use think\Controller;

class User extends Controller
{
    public function login()
    {
        $user = session('o2o_user', '', 'o2o');
        if ($user) {
            $this->redirect('index/index');
        }
        return $this->fetch();
    }

    public function register()
    {
        if (request()->isPost()) {
            $data = input("post.");
            if (captcha_check($data['verifyCode'])) {
                if ($data['password']!==$data['repassword']) {
                    $this->error("两次密码不一致");
                }
                $data['code'] = mt_rand(100, 100000);
                $data['password'] = md5($data['password'].$data['code']);
                try {
                    //user表中username和email为唯一索引，若传入的值重复则会抛出异常
                    $res = model("user")->add($data);
                } catch (\Exception $e) {
                    $this->error($e->getMessage());
                }
                if ($res) {
                    $this->success("注册成功!", url("user/login"));
                } else {
                    $this->error("注册失败!");
                }
            } else {
                return $this->error("验证码错误!");
            }
        } else {
            return $this->fetch();
        }
    }

    public function logincheck()
    {
        if (!request()->isPost()) {
            $this->error("提交不合法!");
        }
        $data = input("post.");
        //TODO 验证
        try {
            $user = model("user")->getUserByUsername($data['username']);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
        if (!$user||$user->status!==1) {
            $this->error("该用户不存在!");
        }
        if (md5($data['password'].$user->code)!==$user->password) {
            $this->error("密码错误!");
        }
        //登录成功
        model("user")->updateById(['last_login_time'=>time()], $user->id);

        //记录用户信息到session
        session('o2o_user', $user, 'o2o');
        $this->success("登录成功!", url("index/index"));
    }

    public function logout()
    {
        session(null, 'o2o');
        $this->redirect("user/login");
    }
}
