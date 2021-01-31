<?php
namespace app\common\model;
class Featured extends BaseModel{
    //根据类型获取数据
    public function getFeaturedByType($type){
        $data =[
            'status' => [0,1],
            'type'=>$type
        ];
        $order =[
            'id'=>'desc'
        ];
        $result= $this->where($data)
        ->order($order)
        ->paginate(2);
        //echo $this->getLastSql();
        return $result;
    }
}