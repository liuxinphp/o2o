<?php 
namespace app\bis\controller;
class Location extends Base{
    //门店列表
    public function index(){
        //查询分店信息
        $Location = model('BisLocation')->getLocation();
        return $this->fetch('',[
            'Location'=>$Location
        ]);
    }
    //新增门店
    public function add(){
        //获取一级城市信息
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级分类信息
        $categorys = model('Category')->getNormalFirstCategory();
        return $this->fetch('',[
            'citys'=>$citys,
            'categorys'=>$categorys
        ]);
    }
    //保存门店信息
    public function save(){
        if(!request()->isPost()){
            $this->error('请求错误');
        }
        $bisId = $this->getLoginUser()->bis_id;
        $data = input('post.');
        //交易提交的信息
        $validate = validate('Bis');
        if(!$validate->scene('add_location')->check($data)){
            $this->error($validate->getError());
        }
        //获取经纬度
        $lnglat=\map::getLngLat($data['address']);
        if(empty($lnglat) || $lnglat['status']!=0 || $lnglat['result']['precise'] !=1){
            $this->error('无法获取数据，或获取数据不精确');
        }
        //店铺信息校验：校验子分类是否存在，如存在多个用|隔开
        $data['cate'] = '';
        if(!empty($data['se_category_id'])){
            $data['cate'] = implode('|',$data['se_category_id']);
        }
        //分店入库信息
        $BisData =[
            'name' =>$data['name'],
            'bis_id'=>$bisId,
            'city_id'=>$data['city_id'],
            'city_path'=>empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'],
            'logo'=>$data['logo'],
            'category_id'=>$data['category_id'],
            'category_path'=>$data['category_id'].','.$data['cate'],
            'address'=>$data['address'],
            'tel'=>$data['tel'],
            'contact'=>$data['contact'],
            //'open_time'=>$data['open_time'],
            'create_time'=>time(),
            'content'=>$data['content'],
            'xpoint'=>empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
            'ypoint'=>empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat'],
            'is_main'=>0,  //1为总店
        ];
        $locationId = model('BisLocation')->add($BisData);
        if($locationId){
            return $this->success('门店申请成功');
        }else{
            return $this->error('门店申请失败');
        }
    }
}