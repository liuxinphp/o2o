<?php 
namespace app\common\model;
use think\Model;
class BaseModel extends Model{
    public function add($data) {
        $data['status'] = 0;
        $this->save($data);
        return $this->id;
    }
}