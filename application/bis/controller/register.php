<?php
namespace app\bis\controller;
use think\console\command\make\Validate;
use think\Controller;
class Register extends Controller{
    public function index(){
        //获取一级城市分类数据
        $citys = model('City')->getNormalCitysByParentId();
        //获取一级分类数据
        $categorys = model('Category')->getNormalCategoryByParentId();
        return $this->fetch('',[
            'citys'=>$citys,
            'categorys' => $categorys
        ]);
    }
    //入驻信息
    public function add(){
        //校验请求模式
        if(!request()->isPost()){
            $this->error('请求错误');
        }
        $data = input('post.');
        //信息校验
        $validate = Validate('Bis');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }  
        //获取经纬度
        $lnglat=\map::getLngLat($data['address']);
        if(empty($lnglat) || $lnglat['status']!=0 || $lnglat['result']['precise'] !=1){
            $this->error('无法获取数据，或获取数据不精确');
        }
        //校验商户是否存在
        $accountResult = model('BisAccount')->get(['username'=>$data['username']]);
        if($accountResult){
            $this->error('用户已存在，请重新填写');
        }
        //商户信息入库
        $BisData = [
            'name'=>$data['name'],
            'city_id'=>$data['city_id'],
            'city_path'=>empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'],
            'logo'=>$data['logo'],
            'create_time'=>time(),
            'licence_logo'=>$data['licence_logo'],    
            'description'=>$data['description'],
            'bank_info'=>$data['bank_info'],
            'bank_user'=>$data['bank_user'],
            'bank_name'=>$data['bank_name'],
            'faren'=>$data['faren'],
            'faren_tel'=>$data['faren_tel'],
            'email'=>$data['email']
        ];
        $bisId = model('Bis')->add($BisData);
        //总店信息校验：校验子分类是否存在，如存在多个用|隔开
        $data['cate'] = '';
        if(!empty($data['se_category_id'])){
            $data['cate'] = implode('|',$data['se_category_id']);
        }
        //总店信息入库
        $locationData = [
            'bis_id'=>$bisId,
            'name'=>$data['name'],
            'logo'=>$data['logo'],
            'tel'=>$data['tel'],
            'contact'=>$data['contact'],
            'category_id'=>$data['category_id'],
            'category_path'=>$data['category_id'].','.$data['cate'],
            'city_id'=>$data['city_id'],
            'city_path'=>empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'],
            'is_main'=>1,  //1代表总店
            'content'=>empty($data['content']) ? '' : $data['content'],
            'address'=>$data['address'],
            'xpoint'=>empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
            'ypoint'=>empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat'],
        ];
        $locationId = model('BisLocation')->add($locationData);
        //账户信息校验，加盐
        $data['code'] = mt_rand(100,10000);
        //账户信息入库
        $accountData =[
            'bis_id'=>$bisId,
            'username'=>$data['username'],
            'code'=>$data['code'],
            'create_time'=>time(),
            'password'=>md5($data['password'].$data['code']),
            'is_main'=>1, //代表总管理员
            'email'=>$data['email']
        ];
        //$userId = model('User')->add($accountData);
        $accountId = model('BisAccount')->add($accountData);

        if(!$accountId){
            $this->error('申请失败');
        }
         //发送邮件
        $url = request()->domain().url('bis/register/waiting',['id'=>$bisId]);
        $title = "o2o平台入驻通知";
        $content="您提交的入驻申请需等待平台方审核，您可以通过点击链接<a href='".$url."' target='_blank'>查看链接</a>查看审核状态";
        \phpmailer\Email::send($data['email'],$title, $content);
        $this->success('申请成功',url('register/waiting',['id'=>$bisId]));
    }
   
    //等待跳转
    public function waiting($id){
        if(empty($id)){
            $this->error('error');
        }
        $detail = model('Bis') -> get($id);
        return $this->fetch('',[
            'detail' => $detail
        ]);
    }
}