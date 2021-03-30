<?php 
namespace app\admin\controller;
use think\Controller;
class Base extends Controller{
    public function status(){
        $data=input('get.');
        if(!is_numeric($data['status'])){
            $this->error('status状态不合法');
        }
        if(empty($data['id'])){
            $this->error('id不合法');
        }
        $validate = validate('status');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        } 
        //获取控制器
        $model = request()->controller();
        $res = model($model)->save(['status'=>$data['status']],['id'=>$data['id']]);
        if($res){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }
    //获取登录账户信息
    public function getLoginUser(){
        if(!$this->account){
            $this->account = session('admin','','o2o');
        }
        return $this->account;
    }
     //退出登录
     public function logout(){
        session(null,'o2o');
        $this->redirect(url('admin/login'));
    }
}