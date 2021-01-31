<?php 
namespace app\common\validate;
use think\Validate;
class Deal extends Validate{
    protected $rule =[
        'name'=>['require'],
        'city_id'=>['integer'],
        'category_id'=>['require'],
        'location_ids'=>['require'],
        'start_time'=>['require'],
        'end_times'=>['require'],
        'total_count'=>['require'],
        'origin_price'=>['require'],
        'current_price'=>['require'],
        'coupons_begin_time'=>['require'],
        'coupons_end_time'=>['require'],
        'description'=>['require'],
        'notes'=>['require'],
        'id'=>['number'],
        'status'=>['integer'],
    ];
    protected $scene =[
        'add'=>['name','city_id','category_id','location_ids','start_time','end_times','total_count','origin_price',
        'current_price','coupons_begin_time','coupons_end_time','description','notes'],
        'status' => ['id','status'],//修改
    ];
}