<?php 
namespace app\common\model;
use think\Model;
class BaseModel extends Model{
    public function add($data) {
        $data['status'] = 0;
        $this->save($data);
        return $this->id;
    }
    public function updateById($data, $id) {
        // allowField 过滤data数组中非数据表中的数据
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
}