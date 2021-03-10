<?php 
namespace app\common\validate;
use think\Validate;
class register extends Validate{
    protected $rule =[
        'username' =>['require'],
        'email'=>['email'],
        'password'=>['require'],
        'repassword'=>['require'],
        'verifycode'=>['require']
    ];
    protected $scene = [
        'register'=>['username','email','password','repassword','verifycode'],
        'login'=>['username','password']
    ];
}