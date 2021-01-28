<?php 
namespace app\common\model;
use think\Db;
class Deal extends BaseModel{
    public function getDeals($status=1){
        $order = [
            'id' =>'desc'
        ];
        $data =[
            'status'=>$status
        ];
        $result = $this->where($data)
        ->order($order)
        ->paginate(2);
        return $result;
    }
     public function getNormalDeals($data = []){
        $data['status'] = 1;
        $order = ['id'=>'desc'];
        $result = $this->where($data)
            ->order($order)
            ->paginate(2);
        echo $this->getLastSql();
        return  $result;
    } 
    public function getDealByConditions($data=[]) {
		$order['id'] = 'desc';
		$datas['status']= 1;
		$result = $this->where(implode(' AND ',$datas))
			->order($order)
			->paginate();
			echo $this->getLastSql();
		return $result;
	}

}