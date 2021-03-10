<?php 
namespace app\admin\Controller;
class Featured extends Base{
    public function index(){
        //获取推荐位类别
        $types = config('featured.featured_type');
        $type=input('get.type',0,'intval');
        //查询推荐信息
        $results = model('Featured')->getFeaturedByType($type);
        return $this->fetch('',[
            'types'=>$types,
            'results'=>$results
        ]);
    }
    //添加
    public function add(){
        if(request()->isPost()){
            //数据入库
            $data = input('post.');
            var_dump($data);
            die();
            //数据严格校验
            $validate = validate('Featured');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $featured = model('Featured')->add($data);
            if($featured){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }else{
            //获取推荐位类别
            $types = config('featured.featured_type');
            return $this->fetch('',[
                'types' =>$types
            ]);
        }  
    }
    
}