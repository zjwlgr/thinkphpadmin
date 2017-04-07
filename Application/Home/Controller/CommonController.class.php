<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {

    public function _initialize(){
        layout('Layout/main');//默认布局
    }

}