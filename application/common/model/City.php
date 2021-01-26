<?php
namespace app\common\model;
use think\Model;
class City extends model{
    //添加城市分类时下拉框选择的城市
    public function getNormalCitysByParentId($parentId=0){
        $data=[
            'status'=>1,
            'parent_id'=>$parentId
        ];
        $order=[
            'id'=>'desc'
        ];
        return $this->where($data)
        ->order($order)
        ->select();
    }
    //获取一级城市分类
    public function getNormalCity($parentId=0){
        $data = [
            'parent_id'=>$parentId
        ];
        $order=[
            'id'=>'desc'
        ];
        return $this->where($data)
        ->order($order)
        ->paginate(5);
    }
    //添加城市
    public function add($data){
        $data['status'] =1;
        $data['create_time'] = time();
        return $this->save($data);
    }
}