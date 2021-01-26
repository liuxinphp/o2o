<?php 
namespace app\bis\controller;
use think\Controller;
class Base extends Controller{
    public $account;
    public function _initialize(){
        //判断用户是否登录
        $isLogin=$this->isLogin();
        if(!$isLogin){
            return redirect(url('login/index'));
        }
    }

    //判断是否登录
    public function isLogin(){
        $user = $this->getLoginUser();
        if($user && $user->id){
            return true;
        }
        return false;
    }

    //获取登录信息
    public function getLoginUser(){
        if(!$this->account){
            $this->account = session('BisAccount','','bis');
        }
        return $this->account;
    }
}