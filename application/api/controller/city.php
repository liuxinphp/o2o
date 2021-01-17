<?php
namespace app\api\controller;
use think\Controller;
class city extends Controller{
    private $obj;
    public function _initinate(){
        $this->obj=model('City');
    }
    public function index(){
        
    }
}