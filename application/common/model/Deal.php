<?php 
namespace app\common\model;
use think\Db;
class Deal extends BaseModel{
    //提交的团购列表
    public function getDeals($status=0){
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
            ->paginate(1);
       }else{
        $sdata['status'] = 1;
        $order = ['id'=>'desc'];
        $result = $this->where([
            ['name', 'like', $sdata['name']['1']],
            ['status', '=','1'],
        ])
            ->order($order)
            ->paginate(1);
       }
        //echo $this->getLastSql();
        return  $result;
    } 

}