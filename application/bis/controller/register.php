<?php
namespace app\bis\controller;

use think\console\command\make\Validate;
use think\Controller;
class Register extends Controller{
    public function index(){
        //获取一级城市分类数据
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级分类数据
        $categorys = model('Category')->getNormalCategoryByParentId();
        return $this->fetch('',[
            'citys'=>$citys,
            'categorys' => $categorys
        ]);
    }
    //入驻信息
    public function add(){
        //校验请求模式
        if(!request()->isPost()){
            $this->error('请求错误');
        }
        $data = input('post.');
        //信息校验
        /* $validate = Validate('Bis');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        } */
        //获取经纬度
        $lnglat=\map::staticimage($data['address']);
    }
}