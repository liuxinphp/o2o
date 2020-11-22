<?php
namespace app\admin\controller;
use think\Controller;
class Index extends controller{
    public function index(){
        return $this->fetch();
    }
    //欢迎
    public function welcome(){
        return 'welcome';
    }
}