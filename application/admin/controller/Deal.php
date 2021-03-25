<?php 
namespace app\admin\controller;
class Deal extends Base{
    public function index(){
        //搜索
        $data=input('get.');
        $sdata=[];
        if(!empty($data['start_time']) && !empty($data['end_times']) && strtotime($data['end_times']) > strtotime($data['start_time'])) {
    		$sdata['create_time'] = [
    			['gt', strtotime($data['start_time'])],
    			['lt', strtotime($data['end_times'])],
    		];
    	}
        if(!empty($data['category_id'])){
            $sdata['category_id'] = $data['category_id'];
        }
        if(!empty($data['city_id'])){
            $sdata['city_id'] = $data['city_id'];
        }
        if(!empty($data['name'])) {
            $sdata['name'] = ['like','%'.$data['name'].'%'];
        }
        //根据搜索框提交的信息查找团购
       // $deals = model('Deal')->getNormalDeals($sdata);
        $deals = model('Deal')->getNormalDeals($sdata);
        //查找城市
        $citys = model('City')->getNormalCitysByParentId($parentId=0);
        //查询分类
        $categorys = model('Category')->getNormalCategoryByParentId($parentId=0);
        //将城市和分类数据转换为数组格式
        $cityArrs=$categoryArrs=[];
        foreach($citys as $city){
            $cityArrs[$city->id] = $city->name;
        }
        foreach($categorys as $category){
            $categoryArrs[$category->id] = $category->name;
        }
        return $this->fetch('',[
            'citys'=>$citys,
            'categorys'=>$categorys,
            'deals'=>$deals,
            'category_id'=>empty($data['category_id']) ? '' :$data['category_id'],
            'city_id'=>empty($data['city_id']) ? '' : $data['city_id'],
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
        	'end_times' => empty($data['end_times']) ? '' : $data['end_times'],
            'name' => empty($data['name']) ? '' : $data['name'],
            'categoryArrs'=>$categoryArrs,
            'cityArrs'=>$cityArrs
        ]);
    }
    public function apply(){
         //搜索
         $data=input('get.');
         $sdata=[];
         if(!empty($data['start_time']) && !empty($data['end_times']) && strtotime($data['end_times']) > strtotime($data['start_time'])) {
             $sdata['create_time'] = [
                 ['gt', strtotime($data['start_time'])],
                 ['lt', strtotime($data['end_times'])],
             ];
         }
         if(!empty($data['category_id'])){
             $sdata['category_id'] = $data['category_id'];
         }
         if(!empty($data['city_id'])){
             $sdata['city_id'] = $data['city_id'];
         }
         if(!empty($data['name'])) {
             $sdata['name'] = ["like",'%'.$data['name'].'%'];
             //转换为字符串
             //$sdata['name'] = implode(" ",$sdata['name']);
         }
         
         //查找城市
         $citys = model('City')->getNormalCitysByParentId($parentId=0);
         //查询分类
         $categorys = model('Category')->getNormalCategoryByParentId($parentId=0);
         //根据搜索框提交的信息查找团购
         $deals = model('Deal')->getDeals();
         
         //将城市和分类数据转换为数组格式
         $cityArrs=$categoryArrs=[];
         foreach($citys as $city){
             $cityArrs[$city->id] = $city->name;
         }
         foreach($categorys as $category){
             $categoryArrs[$category->id] = $category->name;
         }
         return $this->fetch('',[
             'citys'=>$citys,
             'categorys'=>$categorys,
             'deals'=>$deals,
             'category_id'=>empty($data['category_id']) ? '' :$data['category_id'],
             'city_id'=>empty($data['city_id']) ? '' : $data['city_id'],
             'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
             'end_times' => empty($data['end_times']) ? '' : $data['end_times'],
             'name' => empty($data['name']) ? '' : $data['name'],
             'categoryArrs'=>$categoryArrs,
             'cityArrs'=>$cityArrs
         ]);
    }
}