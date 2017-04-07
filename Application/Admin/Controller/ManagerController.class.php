<?php
namespace Admin\Controller;

class ManagerController extends CommonController {

    /*管理员列表*/
    public function lists(){
        $search = I('get.search');
        $group_id = I('get.groupid');
        $result = \Admin\Model\ManagerModel::getList(20,$search,$group_id);
        foreach($result['list'] as $key => $val){
            $group = \Admin\Model\ManagerGroupModel::getOne($val['group_id']);
            $result['list'][$key]['groupname'] = $group['gname'];
        }
        $result['select_list'] = \Admin\Model\ManagerGroupModel::selectList();
        $result['title'] = '管理员管理-列表';
        $this->assign($result);
        $this->display();
    }

    /*管理员添加页面、操作*/
    public function add(){
        if(IS_POST){
            $ManagerInfoPost = I('post.ManagerInfo');
            $result = \Admin\Model\ManagerModel::adds($ManagerInfoPost);
            if($result){
                $this->success('管理员新增成功！',U('Manager/lists'));
            }else{
                $this->error('用户 '.$ManagerInfoPost['username'].' 已存在，请更换！');
            }
        }else{
            $count = \Admin\Model\ManagerModel::counts();
            $select_list = \Admin\Model\ManagerGroupModel::selectList();
            $data = [
                'title' => '管理员管理-新增',
                'count' => $count,
                'select_list' => $select_list,
            ];
            $this->assign($data);
            $this->display();
        }
    }

    /*编辑管理员页面、操作*/
    public function up(){
        if(IS_POST){
            $ManagerInfoPost = I('post.ManagerInfo');
            $result = \Admin\Model\ManagerModel::up($ManagerInfoPost);
            if($result){
                $this->success('管理员编辑成功！',U('Manager/lists'));
            }else{
                $this->error('用户 '.$ManagerInfoPost['username'].' 已存在，请更换！');
            }
        }else {
            $count = \Admin\Model\ManagerModel::counts();
            $select_list = \Admin\Model\ManagerGroupModel::selectList();
            $manager_one = \Admin\Model\ManagerModel::getOne(I('get.id'));
            $data = [
                'title' => '管理员管理-编辑',
                'count' => $count,
                'select_list' => $select_list,
                'one' => $manager_one
            ];
            $this->assign($data);
            $this->display();
        }
    }

    /*删除管理员操作*/
    public function delete(){
        $id = I('get.id');
        if($id != 1) {//默认管理员 不能被删除
            \Admin\Model\ManagerModel::deletes($id);
        }
        redirect(U('Manager/lists'));
    }

    /*修改密码页面*/
    public function editpwd(){
        $manager_sess = $this->manager_sess;
        $manager_sess['title'] = '修改密码';
        $this->assign($manager_sess);
        $this->display();
    }

    /*修改密码操作*/
    public function deitpwd_action(){
        $post = I('post.');
        $post = $post['ManagerInfo'];
        $result = \Admin\Model\ManagerModel::editpwd($post);
        if($result){
            $this->success('密码修改成功，页面跳转后将重新登录！',U('Login/loginout'));
        }else{
            $this->error('旧密码输入错误！');
        }
    }


}