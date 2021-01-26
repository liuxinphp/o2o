<?php 
namespace app\admin\validate;
use think\Validate;
class Location extends Validate{
    protected $rule =[
        'id' =>['integer'],
        'parent_id'=>['number'],
       'id'=>['number']
    ];
    protected $scene =[
        'status' =>['id','status']
    ];
}