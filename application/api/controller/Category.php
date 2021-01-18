<?php
namespace app\api\controller;
use think\Controller;
class Category extends Controller{
    private $obj;
    public function _initinate(){
        $this->obj=model('City');
    }
    public function getCategoryByParentId(){
        $id = input('post.id');
        if(!$id){
            $this->error('ID不合法');
        }
        //通过父类ID获取二级分类
        $categorys = model('Category')->getNormalCategoryByParentId($id);
        if(!$categorys) {
            return show(0,'error');
        }
        return show(1,'success', $categorys);
    }
}