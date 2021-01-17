<?php 
namespace app\admin\validate;
use think\Validate;
class Bis extends Validate{
    protected  $rule = [
       //tp5.1写法
       'id'=>['number'],
       'status'=>['integer']
    ];
    /* 场景设置 */
    protected $scene = [
        'add' => ['name'],
        'update' => ['name'],
        'status' => ['id','status']
    ];
}