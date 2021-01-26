<?php 
namespace app\admin\controller;
use think\Controller;
class City extends Controller{
    public function index(){
        $parentId = input('get.parent_id',0,'intval');
        $citys = model('City')->getNormalCity($parentId);
        return $this->fetch('',[
            'citys' => $citys
        ]);
    }
    //添加城市分类数据
    public function add(){
        $citys = model('City')->getNormalCitysByParentId();
        return $this->fetch('',[
            'citys' => $citys
        ]);
    }
    //保存数据入库
    public function save(){
        //校验提交方式
        if(!request()->isPost()){
            $this->error('请求方式错误');
        }
        $data=input('post.'); //获取提交的数据
        //校验数据
        $validate = validate('city');
        if(!empty($data['id'])){
            return $this->update($data);
        }
        if(!$validate->scene('save')->check($data)){
            $this->error($validate->getError());
        }
        //保存数据
        $city = model('City')->add($data);
        if($city){
            $this->success('城市添加成功');
        }else{
            $this->error('城市添加失败');
        }
    }
    //更新
    public function update($data){
        $res = model('City')->save($data,['id'=>intval($data['id'])]);
        if($res){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }
    //修改城市状态
    public function status(){
        $data = input('get.');
            $validate = validate('city');
            if(!$validate->scene('status')->check($data)){
                $this->error($validate->getError());
            }
            $status = model('city')->save(['status'=>$data['status']],['id'=>$data['id']]);
            if($status){
                $this->success('状态修改成功');
            }else{
                $this->error('修改失败');
            }
    }
    //编辑
    public function edit($id=0){
        if(intval($id<1)){
            $this->error('参数不合法');
        }
        $city = model("City")->get($id); //获取id的内容
        $citys = model('City')->getNormalCitysByParentId($parentId=0);
        return $this->fetch('',[
            'city' => $city,
            'citys' => $citys
        ]);
    }
}