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
        $this->assign('controller',strtolower(request()->controller()));
        return $this->fetch('',[
            'citys' => $citys,
            'meishicates' => $meishicates,
            'datas' => $datas,
            
        ]);
    }
}
