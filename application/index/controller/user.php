<?php
namespace app\index\controller;
use Exception;
class User extends Base
{
    //登录首页
    public function login()
    {
        $user=session('user','','o2o');
        if($user){
            $this->redirect(url('index/index'));
        }
        return $this->fetch();
    }
    //注册
    public function register()
    {
        if(request()->isPost()){
            $data = input('post.');
            //数据严格校验
            $validate = validate('register');
            if(!$validate->scene('register')->check($data)){
                $this->error($validate->getError());
            }
           
                if($data['password'] != $data['repassword']){
                    $this->error('密码不一致');
                }
                if(!captcha_check($data['verifycode'])){
                    $this->error('验证码错误');
                }
                $data['code'] = mt_rand(1000,10000);//盐值
                $data['create_time'] = time();
                $data['password'] = md5($data['password'].$data['code']);
                try{
                    $res = model('User')->add($data);
                }catch(Exception $e){
                $this->error($e->getMessage());
                }
                if($res){
                    $this->success('注册成功',url('user/login'));
                }else{
                    $this->error('注册失败');
                }
        }else{
            return $this->fetch();
        }
    }
    //登录校验
    public function logincheck(){
        //判断提交方式
        if(!request()->isPost()){
            $this->error('提交方式错误');
        }
        //获取输入信息
        $data = input('post.');
        //校验信息
        $validate = validate('register');
        if(!$validate->scene('login')->check($data)){
            $this->error($validate->getError());
        }
        try{
        //数据库查询信息
        $user = model('User')->get(['username'=>$data['username']]);
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }
        if(!$user){
            $this->error('用户名不存在');
        }
        if(md5($data['password'].$user['code']) != $user['password']){
            $this->error('密码不正确');
        }else{
            model('User')->updateById(['last_login_time'=>time()],$user->id);
            session('user',$user,'o2o');//信息存入session
            $this->success('登录成功',url('index/index'));
        }
    }
    //退出登录
    public function logout(){
        session(null,'o2o');
        $this->redirect(url('user/login'));
    }
}


