<?php 
namespace app\admin\controller;
class User extends Base{
    public function login(){
        $user = session('admin','','o2o');
        if($user){
            $this->redirect(url('admin/index'));
        }
        return $this->fetch();
    }
    //校验登录
    public function loginCheck(){
        //判断提交方式
        if(!request()->isPost()){
            $this->error('提交方式错误');
        }
        //获取提交的登录信息
        $data = input('post.');
        //校验登录信息 
        $validate = validate('register');
        if(!$validate->scene('login')->check($data)){
            $this->error($validate->getError());
        }
        //判断用户名和密码是否正确
        try{
            $user = model('User')->get(['username'=>$data['username']]);
        }catch(\Exception $e){
            $this->error($e->getMessage());
        }
        if(!$user){
            $this->error('用户名不存在');
        }
        if(md5($data['password'].$user['code'])!=$user['password']){
            $this->error('密码不正确');
        }else{
            session('admin',$user,'o2o');
            $this->success('登录成功',url('index/index'));
        }
    }
    //退出登录
    public function logout(){
        session(null,'o2o');
        $this->redirect('index/index');
    }
}