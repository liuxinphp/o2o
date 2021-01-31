<?php 
namespace app\admin\validate;
use think\Validate;
class Featured extends Validate{
    protected $rule =[
        'title' => 'require',
        'types' => 'require',
        'url'=>'url|require',
        'description'=>'require'
    ];
    protected $scene =[
        'add' =>['title','url','description']
    ];
}