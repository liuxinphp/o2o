<?php
namespace app\index\controller;
use think\Controller;
class User extends Controller
{
    //登录
    public function login()
    {
        return $this->fetch();
    }
    //注册
    public function register()
    {
        if(request()->isPost()){
            $data = input('post.');
            
            if(!captcha_check($data['verifycode'])){
                $this->error('验证码错误');
            }
        }else{
            return $this->fetch();
        }
    }
}


