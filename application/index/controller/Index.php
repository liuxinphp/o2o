<?php
namespace app\index\controller;
class Index extends Base
{
    public $city = '';
    public $account = '';
    public function index()
    {
        // 城市数据
        $citys = model('City')->getNormalCity();
        $this->getCity($citys);//调用自定义城市方法
        $this->assign('city',$this->city);//模板赋值
        $this->assign('user',$this->getLoginUser());//登录信息
        $cates = $this->getRecommendCates();//获取所有分类
        $this->assign('cates',$cates);
        $cate = $this->getFirstRecommendCates();//一级分类
        $this->assign('cate',$cate);
        //商品分类数据
        $datas = model('Deal')->getNormalDealByCategoryCityId(2,$this->city->id);
        //获取4个子分类
        $meishicates = model('Category')->getSedRecommendCategory(2);
        return $this->fetch('',[
            'citys' => $citys,
            'meishicates' => $meishicates,
            'datas' => $datas
        ]);
    }
    //自定义城市
    public function getCity($citys){
        foreach($citys as $city){
            $city=$city->toArray();
            if($city['is_default']==1){
                $defaultname = $city['name'];
                break;//终止foreachs
            }
        }
        $defaultname = $defaultname ? $defaultname : '西安';
        if(session('cityname','','o2o') && !input('get.city')){
            $cityname = session('cityname','','o2o');
        }else{
            $cityname = input('get.city',$defaultname,'trim');
            session('cityname',$cityname,'o2o');
        }
        //获取城市表中数据
        $this->city=model('City')->where(['name'=>$cityname])->find();
    }
   
    //获取登录账户信息
    public function getLoginUser(){
        if(!$this->account){
            $this->account = session('user','','o2o');
        }
        return $this->account;
    }
    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
     //获取一级分类数据
     public function getFirstRecommendCates(){
        $parentIds = $sedcatArr = $recomCats=[];
        //获取一级分类
        $cate = model('Category')->getNormalCategoryByParentId();
        return $cate;
    }
    //获取所有分类数据
    public function getRecommendCates(){
        $parentIds = $sedcatArr = $recomCats=[];
        //获取一级分类
        $cates = model('Category')->getFirstRecommendCategory(0,5);
        //遍历一级分类，获取一级分类id
        foreach($cates as $cate){
            $parentIds[] = $cate->id;
        }
        //根据一级分类查找二级分类
        $sedCates = model('Category')->getSedRecommendCategory($parentIds);
        foreach($sedCates as $sedcat){
            $sedcatArr[$sedcat->parent_id][] = [
                'id' =>$sedcat->id,
                'name'=>$sedcat->name
            ];
        }
        //组装分类数据，包含全部数据
        foreach($cates as $cate){
            $recomCats[$cate->id] = [$cate->name,empty($sedcatArr[$cate->id]) ? [] : $sedcatArr[$cate->id]];
        }
        /* var_dump($recomCats);
        die(); */
        return $recomCats;
    }
}
