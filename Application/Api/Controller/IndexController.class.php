<?php
namespace Api\Controller;
use Think\Controller\RestController;
class IndexController extends RestController {

    public function test(){
        $phone = I('get.phone');
        $new_sign = sha1(md5(date("YmdHi").'&%@$Xi768'.$phone));
        echo $new_sign;
    }

    /*取服务器时间接口*/
    public function serverTime(){
        $data = array("date1"=>date("Y-m-d H:i"),"date2"=>date("YmdHi"),"date3"=>time());
        $this->response($data,'json');
    }

    public function index(){
        echo 'Api_Index';
    }

    /*关于我们页面*/
    public function abouturl(){
        $this->display();
    }



}