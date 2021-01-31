<?php 
namespace app\admin\validate;
use think\Validate;
class Status extends Validate{
    protected $rules = [
        'id' =>['integer'],
        'parent_id'=>['number'],
        'id'=>['number'],
        'status'=>['number']
    ];
    protected $scene = [
        'status' =>['id','status']
    ];
}