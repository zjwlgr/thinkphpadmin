<?php
namespace Admin\Controller;

class IndexController extends CommonController {

    public function index(){
        $this->assign(['title' => '系统信息查看']);
        if(!empty(I('get.act'))){layout(false);}
        $this->display();
    }

}