<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status){
    if($status==1){
        $str = "<span class='label label-success radius'>正常</span>";
    }elseif($status==0){
        $str = "<span class='label label-danger radius'>待审</span>";
    }else{
        $str = "<span class='label label-danger radius'>删除</span>";
    }
    echo $str;
}
//判断店铺级别
function is_main($is_main){
    if($is_main==1){
        $str = "是";
    }else{
        $str = "否";
    }
    return $str;
}
//获取地址
function doCurl($url, $type=0, $data=[]) {
    $ch = curl_init(); // 初始化
    // 设置选项
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER,0);

    if($type == 1) {
        // post
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }           

    //执行并获取内容
    $output = curl_exec($ch);
    // 释放curl句柄
    curl_close($ch);
    return $output;
}
//商户入驻申请文案
function bisRegister($status){
    if($status==1){
        $str = "申请成功";
    }elseif($status==0){
        $str = "等待平台审核，审核通过后会发送邮件通知，请注意查收";
    }elseif($status==2){
        $str = "非常抱歉，您提交的材料不符合要求";
    }else{
        $str = "该申请已被删除";
    }
    echo $str;
}
//分页函数
function pagination($obj) {
    if(!$obj) {
        return '';
    }
    // 优化的方案
    $params = request()->param();
    return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-o2o">'.$obj->appends($params)->render().'</div>';
}
//获取二级城市数据
function getSeCityName($path){
    if(empty($path)){
        return '';
    }
    if(preg_match('/,/',$path)){
        $cityPath = explode(',',$path);
        $cityId = $cityPath['1'];
    }else{
        $cityId=$path;
    }
    $city = model('City')->get($cityId);
    return $city->name;
}
//查询通用城市
function countLocation($ids){
    if(!$ids){
        return 1;
    }
    if(preg_match('/,/',$ids)){
        $arr = explode(',',$ids);
        return count($arr);
    }
}
//订单编号
function setOrderNo(){
    list($t1,$t2) = explode(' ',microtime());
    $t3 = explode(".",$t1);
    return $t2.$t3[0].rand(10000,99999);
}