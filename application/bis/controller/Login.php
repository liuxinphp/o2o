<?php
namespace app\bis\controller;
use think\Controller;
class Login extends Controller{
    public function index(){
        if(!request()->isPost()){
            $this->error('请求错误');
        }
        $data=input('post.');

        
    }
}