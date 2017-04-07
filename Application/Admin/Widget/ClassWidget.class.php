<?php
namespace Admin\Widget;

class ClassWidget extends \Think\Controller {

    /*无限级分类公用部分*/
    public function clalist($params){
        layout(false);//关闭布局
        $this->assign('params',$params);
        $this->display('Class:clalist');
    }

}