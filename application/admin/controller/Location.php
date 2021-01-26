<?php 
namespace app\admin\controller;
use think\Controller;
class Location extends Controller{
    //分店列表
    public function index(){

        return $this->fetch('',[

        ]);
    }
    //分店开始申请
    public function apply(){     
       //查询分店信息
        $Location = model('BisLocation')->getLocationStatus();
        return $this->fetch('',[
            'Location'=>$Location
        ]);
    }
    //分店审核
    public function status(){
        $data = input('get.');
        $id = $data['id'];
        $validate = validate('Location');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        //修改状态
        $Location = model('BisLocation')->updateById($data, $id);
        if($Location){
            $this->success('审核通过');
        }else{
            $this->error('审核不通过');
        }
    }
}