<?php 
namespace app\common\model;
class User extends BaseModel{
    
    //注册
    public function add($data=[]){
        if(!is_array($data)){
            exception('传递的数据不是数组');
        }
        $data['status']=1;
        return $this->data($data)->allowField(true)->save();
    }
}