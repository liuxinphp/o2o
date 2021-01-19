<?php 
namespace app\common\model;
class Bis extends BaseModel{
    /* 
    通过状态查询商家信息
    */
    public function getBisByStatus() {
        $order = [
            'id' => 'desc',
        ];

        $data = [
            'status' => [0,1]
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate();
        return $result;
    }

    
}