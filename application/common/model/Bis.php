<?php 
namespace app\common\model;
class Bis extends BaseModel{
    /* 
    通过状态查询商家信息
    */
    public function getBisByStatus($status=0) {
        $order = [
            'id' => 'desc',
        ];
        $data = [
            'status' => $status
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate(5);
        return $result;
    }

    
}