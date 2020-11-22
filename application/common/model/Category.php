<?php
namespace app\common\model;
use think\Model;
class Category extends model{
    protected $autoWriteTimestamp = true;
    public function add($data){
        $data['status'] = 1;
       // $data['create_time'] = time();
        return $this->save($data);
    }
    //获取一级分类
    public function getNormalFirstCategory(){
        $data = [
            'status'=>1,
            'parent_id'=>0
        ];
        $order=[
            'id'=>'desc'
        ];
        return $this->where($data)
        ->order($order)
        ->select();
    }
} 