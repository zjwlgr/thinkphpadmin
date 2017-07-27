<?php
namespace Home\Controller;

class FormController extends CommonController {

    /*登记表页面*/
    public function index(){
        $classlist = M('class')->where("fid='186'")->select();
        $data = array(
            'classlist' => $classlist
        );
        $this->assign($data);
        $this->display();
    }

    /*登记表提交操作处理*/
    public function action(){
        $form = M('form');
        if($form->create()){
            $form->ctime = time();
            $form->add();
            $this->success("登记表提交成功，谢谢您的反馈！",U('index'));
        }else{
            $this->error($form->getError(),U('index'));
        }
    }

}