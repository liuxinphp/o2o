<?php
namespace app\admin\controller;
use think\Controller;
class Category extends controller{
    private $obj;
    public function _initialize(){
        $this->obj=model("Category");
    }
    public function index(){
        return $this->fetch();
    }
    //增加
    public function add(){
       $categorys=model("Category")->getNormalFirstCategory();
        return $this->fetch('',[
            'categorys'=>$categorys
        ]);
    }
    //保存数据
    public function save(){
        $data = input('post.');
        $data['status']=10;
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        //将数据提交Model层
        $res=model('Category')->add($data);
        if($res){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
    }                                                   
}