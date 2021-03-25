<?php 
namespace app\common\model;
class BisLocation extends BaseModel{
    public function updateById($data, $id) {
        // allowField 过滤data数组中非数据表中的数据
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
    //获取分店信息用户端
    public function getLocation($bisId=0){
        $order = [
            'id' =>'desc',
        ];
        $data = [
            'status'=>[0,1],
            'bis_id'=>$bisId
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate(5);
        return $result;
    }
    //获取分店申请信息（后台）
    public function getLocationStatus(){
        $order = [
            'id' =>'desc',
        ];
        $data = [
            'status'=>[0],
            'is_main'=>[0]
        ];
        $result = $this->where($data)
            ->order($order)
            ->select();
        return $result;
    }
    //获取店铺信息（后台）
    public function getLocations($bisId=0){
        $order = [
            'id' =>'desc',
        ];
        $data = [
            'status'=>[1],
            'bis_id'=>$bisId
        ];
        $result = $this->where($data)
            ->order($order)
            ->paginate(5);
           // echo $this->getLastSql();
        return $result;
    }
    //获取分店信息（后台）
    public function getBranch($bisId){
        $order = [
            'id' =>'desc',
        ];
        $data = [
            'status'=>[1],
            'is_main'=>[0],
            'bis_id'=>$bisId
        ];
        $result = $this->where($data)
            ->order($order)
            ->select();
        return $result;
    }
    public function getNormalLocationsInId($ids){
        $data=[
            'id'=>['in',$ids],
            'status'=>1
        ];
        return $this->where($data)
        ->select();
    }
}