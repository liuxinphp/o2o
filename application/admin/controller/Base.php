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
}