<?php 
namespace app\common\model;
use think\Db;
class Deal extends BaseModel{
    //提交的团购列表
    public function getDeals($status=0,$bisId=0){
        $order = [
            'id' =>'desc'
        ];
        $data =[
            'status'=>$status,
            'bis_id' => $bisId
        ];
        $result = $this->where($data)
        ->order($order)
        ->paginate(5);
      
        return $result;
    }
    /*  public function getNormalDeals($data = []){
        $data['status'] = 1;
        $order = ['id'=>'desc'];
        $result = $this->where($data)
            ->order($order)
            ->paginate(2);
        echo $this->getLastSql();
        return  $result;
    }  */
    //已审核的团购列表
    public function getNormalDeals($sdata=[]){
       if(empty($sdata['name'])){
        $sdata['status'] = 1;
        $order = ['id'=>'desc'];
        $result = $this->where($sdata)
            ->order($order)
            ->paginate(5);
       }else{
        $sdata['status'] = 1;
        $order = ['id'=>'desc'];
        $result = $this->where([
            ['name', 'like', $sdata['name']['1']],
            ['status', '=','1'],
        ])
            ->order($order)
            ->paginate(5);
       }
        //echo $this->getLastSql();
        return  $result;
    } 
    /* 
    根据分类以及城市获取分类数据
    */
    public function getNormalDealByCategoryCityId($id,$cityId,$limit=10){
        $data = [
           // 'end_times' => ['gt',time()],
            'category_id' => $id,
            'city_id' => $cityId,
            'status' =>1
        ];
        $order = [
            'listOrder' => 'desc',
            'id' =>'desc'
        ];
        $result = $this->where($data)
        ->order($order)->select();
        return $result;
       // var_dump($result);
        /* if($limit){
            $result = $result->limit($limit);
        } */
        //return $result->select();
    }
}