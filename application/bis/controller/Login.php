<?php
namespace app\bis\controller;
use think\Controller;
class Login extends Controller{
    public function index(){
        if(request()->isPost()){
        $data=input('post.');
        //查询用户信息
        $bis = model('BisAccount')->get(['username'=>$data['username']]);

        if(!$bis || $bis->status!=1){
            $this->error('用户不存在或未审核通过');
        }
        if($bis->password != md5($data['password'].$bis->code)){
            $this->error('密码错误');
        }
        model('BisAccount')->updateById(['last_login_time'=>time()], $bis->id);
        session('BisAccount',$bis,'bis');
        return $this->success('登录成功');
    }else{
        //获取session
        $account = session('BisAccount','','bis');
        if($account && $account->id){
            return $this->redirect(url('index/index'));
        }
        return $this->fetch();
    }
        
    }
}