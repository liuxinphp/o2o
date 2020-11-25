<?php
namespace app\admin\controller;
use think\Controller;
class Category extends controller{
    private  $obj;
    public function _initialize() {
        $this->obj = model("Category");
    }
    public function index(){
        $parentId = input('get.parent_id',0,'intval');
        $categorys = model("category")->getFirstCategorys($parentId);
        return $this->fetch('',[
            'categorys' => $categorys
        ]);
    }
    //增加
    public function add() {
        $categorys = model("Category")->getNormalFirstCategory();
        return $this->fetch('', [
            'categorys'=> $categorys,
        ]);
    }

    //保存数据
    public function save(){
        /* 严格校验 */
        if(!request()->isPost()){
            $this->error('请求失败');
        }
        $data = input('post.');
       // $data['status']=10;
        $validate = validate('Category');
        if(!empty($data['id'])){
            return $this->update($data);
        }
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        
        //将数据提交Model层
        $res=model("Category")->add($data);
        if($res){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
    }            
    //更新
    public function update($data){
        $res = model("Category")->save($data,['id'=>intval($data['id'])]);
        if($res){
            $this->success("修改成功");
        }else{
            $this->error("修改失败");
        }
    }
    //编辑
    public function edit($id=0){
        if(intval($id<1)){
            $this->error('参数不合法');
        }
        $category = model("Category")->get($id); //获取id的内容
        $categorys = model("Category")->getFirstCategorys();//获取整个分类内容
        return $this->fetch('',[
            'category' => $category,
            'categorys' => $categorys
        ]);
    }                                       
}