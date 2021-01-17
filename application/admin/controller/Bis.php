<?php 
namespace app\admin\controller;
use think\Controller;
class Bis extends Controller{
    private  $obj;
    public function _initialize() {
        $this->obj = model("Bis");
    }
    /**
     * 正常的商户列表
     * @return mixed
     */
    public function index() {
        $bis = model('Bis')->getBisByStatus();
        return $this->fetch('', [
            'bis' => $bis,
        ]);
    }
    //修改状态
    public function status(){
       $data = input('get.');
       $validate = validate('Bis');
       if(!$validate->scene('status')->check($data)){
           $this->error($validate->getError());
       }
       $res=model("Bis")->save(['status'=>$data['status']],['id'=>$data['id']]);
       if($res){
           $this->success('状态修改成功');
       }else{
           $this->error('修改失败');
       }
    }
    //编辑
    public function detail(){
        $id=input('get.id');
        if(empty($id)){
            return $this->error('ID错误');
        }
        //获取城市分类数据

        //获取一级分类数据
        return $this->fetch();
    }
}