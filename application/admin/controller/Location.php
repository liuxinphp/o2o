<?php 
namespace app\admin\controller;

use think\console\command\make\Validate;

class Location extends Base{
    //总店列表
    public function index(){
        //查询总店信息
        $Location = model('BisLocation')->getLocations();
        return $this->fetch('',[
            'Location' => $Location
        ]);
    }
    //分店列表
    public function branch(){
        $bisId= input('get.bis_id',0,'intval');
        $branch = model('BisLocation')->getBranch($bisId);
        return $this->fetch('',[
            'branch' => $branch
        ]);
    }
    //分店开设申请
    public function apply(){     
       //查询分店信息
        $Location = model('BisLocation')->getLocationStatus();
        return $this->fetch('',[
            'Location'=>$Location
        ]);
    }
    //分店状态审核
    public function status(){
        $data = input('get.');
        $validate = Validate('Location');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        //保存更新信息
        $res = model('BisLocation')->save(['status'=>$data['status']],['id'=>$data['id']]);
        if($res){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }
}