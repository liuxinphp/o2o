<?php 
namespace app\admin\controller;
use think\Controller;
class Bis extends Controller{
    private  $obj;
    public function _initialize() {
        $this->obj = model("Bis");
    }
    /**
     * 正常的商户列表
     * @return mixed
     */
    public function index() {
        $bis = model('Bis')->getBisByStatus(1);
        return $this->fetch('', [
            'bis' => $bis,
        ]);
    }
    //修改状态
    public function status(){
       $data = input('get.');
       $validate = validate('Bis');
       if(!$validate->scene('status')->check($data)){
           $this->error($validate->getError());
       }
       //保存更新信息
       $res=model("Bis")->save(['status'=>$data['status']],['id'=>$data['id']]);
       $location = model('BisLocation')->save(['status'=>$data['status']],['bis_id'=>$data['id'],'is_main'=>1]);
       $account = model('BisAccount')->save(['status'=>$data['status']],['bis_id'=>$data['id'],'is_main'=>1]);
       //跟进id查找商户信息
       $bis=model('Bis')->get(['id'=>$data['id']]);
       $urlL = request()->domain().url('./bis/login'); //登录链接
       $urlR = request()->domain().url('./bis/register'); //注册链接
       if($res && $location && $account){
           if($data['status']==1){
            $title="审核成功";
            $content="恭喜您入驻审核成功，您可以点击链接<a href='".$urlL."' target='_blank'>点击链接登录</a>登录";
            \phpmailer\Email::send($bis['email'],$title, $content);
           }else{
            $title="审核不通过";
            $content="审核不通过，您可以点击链接<a href='".$urlR."' target='_blank'>点击链接登录</a>重新提交资料";
            \phpmailer\Email::send($bis['email'],$title, $content);
           }
           $this->success('状态修改成功');
       }else{
           $this->error('修改失败');
       }
        
    }
    //编辑
    public function detail(){
        $id=input('get.id');
        if(empty($id)){
            return $this->error('ID错误');
        }
        //获取城市分类数据
        $citys = model('city')->getNormalCitysByParentId();
        //获取一级分类数据
        $categorys = model('Category')->getNormalCategoryByParentId();
        //查询指定商户信息
        $bisData = model('Bis')->get(['id'=>$id]);
        //查询账户信息
        $accountData = model('BisAccount')->get(['bis_id=>$id','is_main'=>1]);
        //查询总店信息
        $bisLocation = model('BisLocation')->get(['bis_id=>$id','is_main'=>1]);
        return $this->fetch('',[
            'citys'=>$citys,
            'categorys'=>$categorys,
            'bisData'=>$bisData,
            'accountData'=>$accountData,
            'bisLocation'=>$bisLocation
        ]);
    }
    //商家入驻申请
    public function apply(){
        $bisApply = model('Bis')->getBisByStatus(0);
        return $this->fetch('',[
            'bisApply'=>$bisApply,
        ]);
    }
    //删除的商户信息
    public function dellist(){
        $bisDel = model('Bis')->getBisByStatus(-1);
        return $this->fetch('',[
            'bisDel' => $bisDel
        ]);
    }
}