<?php
namespace app\index\controller;
use think\Controller;

class Detail extends Base{
    public function index($id){
        $this->assign('title','o2o团购网');
        if(!intval($id)){
            $this->error('ID不合法');
        }
        //根据id查询商品数量
        $deal = model('Deal')->get($id);
        //获取商户bis_id，根据商户id查找商户信息
        $bisId = $deal->bis_id;
        $bis = model('Bis')->get($bisId);
        if(!$deal || $deal->status !=1){
            $this->error('该商品不存在');
        }
         // 城市数据
         $citys = model('City')->getNormalCity();
         $this->getCity($citys);//调用自定义城市方法
         $this->assign('city',$this->city);//模板赋值自定义城市
         $this->assign('user',$this->getLoginUser());//登录信息
         $cates = $this->getRecommendCates();//获取所有分类
         $this->assign('cates',$cates);
         $cate = $this->getFirstRecommendCates();//一级分类
         $this->assign('cate',$cate);
         $this->assign('controller',strtolower(request()->controller()));
         //获取分类数据
         $category = model('Category')->get($deal->category_id);
         //获取分店信息
         $locations = model('BisLocation')->getNormalLocationsInId($deal->location_ids);
         //判断团购时间
         $flag=0;
         if($deal->start_time>time()){
             $flag = 1;
             //计算剩余时间
            $dtime = $deal->start_time - time();
            $timedate = "";
            $d = floor($dtime/(3600*24));
            if($d){
                $timedate .= $d."天";
            }
            $h = floor($dtime%(3600*24)/3600);
            if($h){
                $timedate .=$h."小时";
            }
            $m = floor($dtime%(3600*24)%3600/60);
            if($m){
                $timedate .= $m."分钟";
            }
            $this->assign('timedate',$timedate);
         }
        return $this->fetch('',[
            'title' =>$deal->name,
            'citys' => $citys,
            'category'=>$category,
            'locations'=>$locations,
            'deal'=>$deal,
            'overplus'=>$deal->total_count-$deal->buy_count,
            'flag'=>$flag,
            'mapstr'=>$locations[0]['xpoint'].','.$locations[0]['ypoint'],
            'bis'=>$bis
        ]
        );
    }
}