<?php
namespace app\admin\controller;
use think\Controller;
class Index extends controller{
    public function index(){
        return $this->fetch();
    }
    public function test(){
        \map::getLngLat('西安市太白南路363号');exit;
        return 'a';
    }
    //调用静态地图
    public function map() {
        return \map::staticimage('西安市雁塔区雁环中路169号');exit;
    }
    //欢迎
    public function welcome(){
        //\phpmailer\Email::send('1391868887@qq.com','163邮箱','终于成功了');
        return '发送成功';
    } 
}

