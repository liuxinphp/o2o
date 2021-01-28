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
    public function getNormalFirstCategory() {
        $data = [
            'status' => 1,
            'parent_id' => 0,
        ];
        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }
    //获取二级分类
    public function getFirstCategorys($parentId=0){
        $data = [
            'parent_id'=>$parentId,
            'status'=>['1','0'],
        ];
        $order = [
            'listOrder'=>'desc',
            'id' =>'desc'
        ];
        $result = $this->where($data)
        ->order($order)
        ->paginate(5);
        //echo $this->getLastSql();
        return $result;
    }
    //获取商户入驻时一级分类数据
    public function getNormalCategoryByParentId($parentId=0){
        $data = [
            'status' =>1,
            'parent_id' => $parentId
        ];
        $order = [
            'id' => 'desc'
        ];
        $result = $this->where($data)
        ->order($order)
        ->select();
        return $result;
    }   
    
} 