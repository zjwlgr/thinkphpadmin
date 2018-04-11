<?php
namespace Api\Controller;
use Think\Controller\RestController;
class CommonController extends RestController  {

    //使用万能接收，将所有参数存入该变量
    protected $postparam;

    protected $uid = 0;

    protected $email;

    public function _initialize(){
        $this->postparam = I('param.');//自动判断请求类型获取GET、POST
        $params = urldecode(file_get_contents("php://input"));
        $d = json_decode($params , true);
        if(!empty($d)){
            $this->postparam = $d;
        }
        //var_dump($this->postparam);exit;
        if(empty($this->postparam['sign']) || empty($this->postparam['phone']) || strlen($this->postparam['phone']) < 11){
            $data['code'] = '403';
            $data['msg'] = '验签缺少参数';
            $this->response($data , 'json');
        }

        $nowCCname = CONTROLLER_NAME.ACTION_NAME;
        if($this->postparam['phone'] != '11111111111' && $nowCCname != 'UsersendCode' && $nowCCname != 'UsercheckUser' && $nowCCname != 'UseruserRegister') {
            $userinfo = M('user')->where("phone='" . $this->postparam['phone'] . "'")->field("id,email")->find();
            if (empty($userinfo)) {
                $data['code'] = '403';
                $data['msg'] = '用户不存在';
                $this->response($data, 'json');
            }
            $this->uid = $userinfo['id'];
            $this->email = $userinfo['email'];
        }

        $result = $this->checkSign($this->postparam['sign'],$this->postparam['phone']);
        if($result == false){
            $data['msg'] = '验签失败';
            $data['code'] = 403;
            $this->response($data,'json');
        }
    }


    //验证签名
    function checkSign($sign,$phone){
        $new_sign = sha1(md5(date("YmdHi").'&%@$Xi768'.$phone));
        $new_sign2 = sha1(md5(date('YmdHi',strtotime('-1 minute')).'&%@$Xi768'.$phone));
        $new_sign3 = sha1(md5(date('YmdHi',strtotime('+1 minute')).'&%@$Xi768'.$phone));
        if($new_sign == $sign || $new_sign2 == $sign || $new_sign3 == $sign){
            return true;
        }else{
            return false;
        }
    }

    protected function succ($data) {
        $this->response([
            'code' => 200,
            'msg' => '',
            'data' => $data
        ], 'json');
    }
    protected function err($code, $msg, $data = []) {
        $this->response([
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ], 'json');
    }

}