<?php 
namespace app\admin\controller;
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
    //分店开始申请
    public function apply(){     
       //查询分店信息
        $Location = model('BisLocation')->getLocationStatus();
        return $this->fetch('',[
            'Location'=>$Location
        ]);
    }
}