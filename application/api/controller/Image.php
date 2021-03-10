<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\File;
class Image extends Controller
{
    public function upload() {
        $file=$this->request->file('file');
        $info=$file->move('upload');
        if($info && $info->getPathname()){
            return $this->show(1,'success','/'.$info->getPathname());
          
        }else{
            return show(0,'upload error'); 
        }
    }
}