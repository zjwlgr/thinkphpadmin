<?php
namespace Admin\Controller;

class ManagerRecordController extends CommonController {


    /*登录日志列表*/
    public function lists(){
        $search = I('get.search');
        $result = \Admin\Model\ManagerRecordModel::getList(20,$search);
        $result['title'] = '管理员登录日志 - 列表';
        $this->assign($result);
        $this->display();
    }

    /*删除单条日志*/
    public function delete(){
        \Admin\Model\ManagerRecordModel::deletes(I('get.id'));
        redirect(U('recordList'));
    }

}