<?php
namespace app\api\controller;
use think\Controller;
class city extends Controller{
    private $obj;
    public function _initinate(){
        $this->obj=model('City');
    }
    public function getCitysByParentId(){
        $id=input('post.id');
        if(!$id){
            $this->error('id不合法');
        }
        //通过id获取二级城市数据
        $citys = model('City')->getNormalCitysByParentId($id);
        if(!$citys){
            return show(0,'error');
        }else{
            return show(1,'success',$citys);
        }
    }
}