<?php
namespace app\index\controller;
use think\Controller;

class Lists extends Base{
    public function index()
    {
        $firstCatId = [];
        // 城市数据
        $citys = model('City')->getNormalCity();
        $this->getCity($citys);//调用自定义城市方法
        $this->assign('city',$this->city);//模板赋值
        //获取一级分类
        $categorys = model('Category')->getNormalFirstCategory();
        foreach($categorys as $category){
            $firstCatId[] = $category->id;
        }
        $id=input('id',0,'intval');
        $data = [];
        if(in_array($id,$firstCatId)){ //一级分类
            $categoryParentId=$id;
            $data['category_id'] = $id;
        }elseif($id){ //二级分类
            //获取二级分类的数据
            $category = model('Category')->get($id);
            if(!$category || $category->status !=1){
                $this->error("数据不合法");
            }
            
            $categoryParentId=$category->parent_id;
            $data['se_category_id'] = $id;
        }else{ //0
            $categoryParentId=0;
        }
        $sedCategorys = [];
        //获取父类下所有子分类
        if($categoryParentId){
            $sedCategorys = model('Category')->getSedRecommendCategory($categoryParentId);
        }     
        $this->assign('user',$this->getLoginUser());//登录信息
        $cates = $this->getRecommendCates();//获取所有分类
        $this->assign('cates',$cates);
        //获取4个子分类
        $this->assign('controller',strtolower(request()->controller()));//传递控制器
        $order = [];
        //获取排序数据
        $order_sales = input('order_sales','');
        $order_price = input('order_price','');
        $order_time = input('order_time','');
        if(!empty($order_sales)){
            $order_flag = 'order_sales';
            $order['order_sales'] = $order_sales;
        }elseif(!empty($order_time)){
            $order_flag = 'order_time';
            $order['order_time'] = $order_time;
        }elseif(!empty($order_price)){
            $order_flag = 'order_price';
            $order['order_price'] = $order_price;
        }else{
            $order_flag = '';
        }
        //根据条件查询团购商品
        $data['city_id'] = $this->city->id;
        $deals = model('Deal')->getDealByCondition($data,$order);
        return $this->fetch('',[
            'citys' => $citys,
            'category'=>$categorys,
            'sedCategorys'=>$sedCategorys,
            'id' =>$id,
            'categoryParentId'=>$categoryParentId,
            'order_flag'=>$order_flag,
            'deals'=>$deals
        ]);
    }
}