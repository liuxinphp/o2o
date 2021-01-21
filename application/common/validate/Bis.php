<?php 
namespace app\common\validate;
use think\Validate;
class Bis extends Validate{
    protected $rule = [
        'name' => 'require|max:25',
        'email'=>'require',
        'logo'=>'require',
        'city_id'=>'require',
        'bank_info'=>'require',
        'bank_name'=>'require',
        'faren'=>'require',
        'tel'=>'require',
        'address'=>'require',
        'username'=>'require',
        'password'=>'require',
        'category_id'=>'require',
        'city_path'=>'require',
        'description'=>'require'
    ];
    //场景设置
    protected $scene = [
        'add'=>['name','email','city_id','bank_info','bank_name','faren','tel','address','description'],
        'login'=>['username','password'],
        'bisAdd'=>['category_id','city_path'],
        'status' => ['id','status'],//修改
    ];
}