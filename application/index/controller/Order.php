<?php 
namespace app\index\controller;
use think\Controller;
class Order extends Base{
    public function index(){
       //判断是否登录
       $user = $this->getLoginUser();
       if(!$user){
        $this->error('请登录','user/login');
       }
       //校验参数
       $id = input('get.id',0,'intval');
       if(!$id){
           $this->error('参数不合法');
       }
       $deal_count = input('get.deal_count',0,'intval');
       $total_price = input('get.total_price',0,'intval');
       //根据id查找对应商品信息
       $deal = model("Deal")->find($id);
       if(!$deal || $deal->status!=1){
           $this->error('商品不存在');
       }
       if(empty($_SERVER['HTTP_REFERER'])){
           $this->error('请求不合法');
       }
       //订单编号
       $out_trade_no = setOrderNo();
       //组装入库数据
       $data =[
            'out_trade_no' => $out_trade_no,
            'deal_count'=>$deal_count,
            'total_price'=>$total_price,
            'username'=>$user->username,
            'user_id'=>$user->id,
            'deal_id'=>$id,
            'referer'=>$_SERVER['HTTP_REFERER']
       ];
       try{
          $orderId = model("Order")->add($data);
       }catch(\Exception $e){
           $this->error('订单创建失败');
       }
       $this->redirect(url('pay/index',['id'=>$orderId]));
       
    }
    //确认订单
    public function confirm(){
        $citys = model('City')->getNormalCity();
        $this->getCity($citys);//调用自定义城市方法
        $this->assign('city',$this->city);//模板赋值
        $this->assign('user',$this->getLoginUser());//登录信息
       //判断是否登录
       if(!$this->getLoginUser()){
           $this->error('请登录','user/login');
       }
       //校验参数
      $id = input('get.id',0,'intval');
      if(!$id){
          $this->error('参数不合法');
      }
      $count = input('get.count',1,'intval');
      //查询商品
      $deal = model('Deal')->find($id);
      
        $this->assign('controller',strtolower(request()->controller()));//传递控制器
        return $this->fetch('',[
            'citys' => $citys,
            'controller'=>'pay',
            'deal'=>$deal,
            'count'=>$count
        ]);
    }
}