<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\File;
class Image extends Controller
{
    public function upload() {
        $file=$this->request->file('file');
       //$file = Request::instance()->file('file');
        $info=$file->move('upload');
        if($info && $info->getPathname()){
            return json(show(1,'success','/'.$info->getPathname()));
        }
        return json(show(0,'upload error'));
    }
}