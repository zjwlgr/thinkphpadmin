<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

    public function index(){
        layout('Layout/base');
        $this->assign(['title' => 'Login']);
        //C('TOKEN_ON',false);//动态关闭表单令牌验证
        $this->display();
    }

    public function login_action(){
        if(IS_AJAX){
            $post = I('post.');

            $token = '';//监听自定义的标签，使用传值方式会返回$token
            \Think\Hook::listen('create_token',$token);

            $result = \Admin\Model\ManagerModel::login($post);

            if($result['token'] == 'no'){
                $this->ajaxReturn(['code' => 0, 'msg' => '页面超时，请在页面刷新后重试！', 'token' => $result['token']]);
            }

            $verify   = new \Think\Verify();
            $verturn  = $verify->check($post['validate'],'');
            if($verturn == false){
                $this->ajaxReturn(['code' => 0, 'msg' => '验证码输入错误！', 'token' => $token]);
            }

            if($result['password'] != md5($post['ManagerInfo']['password'])){
                $this->ajaxReturn(['code' => 0, 'msg' => '用户名或密码错误！', 'token' => $token]);
            }

            if($result['locking'] == 1){
                $this->ajaxReturn(['code' => 0, 'msg' => '该管理员已被系统锁定！', 'token' => $token]);
            }

            unset($result['password']);//sesssion 不记录密码
            session('manager',$result);//注册session
            \Admin\Model\ManagerModel::setData($result['id'],$result['number']);//更新次数、ip、登录时间
            \Admin\Model\ManagerRecordModel::insert($result);//记录管理员登录信息
            $this->ajaxReturn(['code' => 1, 'msg' => U('Index/index')]);
        }
    }

    public function verify(){
        $config =    array(
            'fontSize'    =>    15,    // 验证码字体大小
            'imageW'      =>    156,    // 验证码宽度 设置为0为自动计算
            'imageH'      =>    33,    // 验证码高度 设置为0为自动计算
            'length'      =>    5,     // 验证码位数
            'useNoise'    =>    true, // 关闭验证码杂点
            'useCurve'    =>    false, // 是否使用混淆曲线 默认为true
            'fontttf'     =>    '4.ttf', // 指定验证码字体 默认为随机获取
            'codeSet'     =>    '0123456789', // 验证码字符集合 3.2.1 新增
            'expire'	  =>	'30'   //验证码的有效期（秒）
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    public function loginout(){
        session('manager',null);
        redirect(U('index'));
    }

}