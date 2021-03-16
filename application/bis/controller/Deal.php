<?php 
namespace app\bis\controller;
class Deal extends Base{
    public function index(){
        $bisId = $this->getLoginUser();
        $deal = model('Deal')->getDeals(1,$bisId['bis_id']);
        $cityArrs=$categoryArrs=[];
        //查询城市
        $citys = model('City')->getNormalCitysByParentId($parentId=0);
        foreach($citys as $city){
            $cityArrs[$city->id]=$city->name;
        }
        //查询分类
        $categorys = model('Category')->getNormalCategoryByParentId();
        foreach($categorys as $category){
            $categoryArrs[$category->id] =$category->name;
        }
        return $this->fetch('',[
            'deal'=>$deal,
            'cityArrs'=>$cityArrs,
            'categoryArrs'=>$categoryArrs
        ]);
    }
    //添加团购商品
    public function add(){
        $bisId = $this->getLoginUser()->bis_id;
        if(request()->isPost()) {
            // 走插入逻辑
            $data = input('post.');
            // 严格校验提交的数据
            $validate = validate('Deal');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            //$location = model('BisLocation')->get($data['location_ids'][0]);
            $deals = [
                'name' => $data['name'],
                'bis_id'=>$bisId,
                'image'=>$data['image'],
                'category_id'=>$data['category_id'],
                'se_category_id'=>empty($data['se_category_id'])?'':implode(',',$data['se_category_id']),
                'city_id'=>$data['city_id'],
                'se_city_id'=>empty($data['se_city_id']) ? '' : $data['se_city_id'],
                'location_ids' => empty($data['location_ids']) ? '' : implode(',', $data['location_ids']),
                'start_time'=>strtotime($data['start_time']),
                'end_times'=>strtotime($data['end_times']),
                'total_count'=>$data['total_count'],
                'origin_price' => $data['origin_price'],
                'current_price'=>$data['current_price'],
                'coupons_begin_time'=>$data['coupons_begin_time'],
                'create_time'=>time(),
                'coupons_end_time'=>$data['coupons_end_time'],
                'description'=>$data['description'],
                'notes'=>$data['notes']
            ];
            $id = model('Deal')->add($deals);
            if($id) {
                $this->success('添加成功', url('deal/index'));
            }else {
                $this->error('添加失败');
            }
        }else {
            //获取城市信息
            $citys = model('City')->getNormalCitysByParentId();
            //获取分类信息
            $categorys = model('Category')->getNormalFirstCategory();
            $bislocations=model('BisLocation')->getLocation();
            return $this->fetch('', [
                'citys' => $citys,
                'categorys' => $categorys,
                'bislocations' => $bislocations,
            ]);
        }
    }
}