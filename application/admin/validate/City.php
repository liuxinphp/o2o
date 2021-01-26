<?php 
namespace app\admin\validate;
use think\Validate;
class City extends Validate{
    protected $rule =[
        'name' => 'require',
        'parent_id' => 'number',
        'status'=>['integer'], //tp5.1数字校验如果存在负数，需要使用integer类型
        'id' => 'number'
    ];

    protected $scene =[
        'save' =>['name','parent_id','id'],
        'status' => ['status','id'],
        'update' => ['name','parent_id']
    ];
}