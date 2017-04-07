<?php
namespace Admin\Controller;

class FunctionController extends CommonController {

    /*系统功能管理-列表*/
    public function lists(){
        $group_list = \Admin\Model\FunctionModel::getGroupList(0);
        foreach($group_list as $key => $val){
            $funt_list = \Admin\Model\FunctionModel::getGroupList($val['id']);
            $group_list[$key]['funt_list'] = $funt_list;
        }
        $result = [
            'title' => '系统功能管理-列表',
            'group_list' => $group_list,
        ];
        $this->assign($result);
        $this->display();
    }

    /*系统功能管理-新增*/
    public function add(){
        if(IS_POST){
            $FunctionInfo = I('post.FunctionInfo');
            $result = \Admin\Model\FunctionModel::adds($FunctionInfo);
            if($result){
                $this->success('系统功能新增成功！',U('Function/lists'));
            }
        }else{
            $group_list = \Admin\Model\FunctionModel::getGroupList(0);
            $result = [
                'title' => '系统功能管理-新增',
                'group_list' => $group_list,
            ];
            $this->assign($result);
            $this->display();
        }
    }
    /*系统功能管理-编辑*/
    public function up(){
        if(IS_POST){
            $FunctionInfo = I('post.FunctionInfo');
            $result = \Admin\Model\FunctionModel::up($FunctionInfo);
            if($result){
                $this->success('系统功能编辑成功！',U('Function/lists'));
            }
        }else{
            $group_list = \Admin\Model\FunctionModel::getGroupList(0);
            $funt_one = \Admin\Model\FunctionModel::getOne(I('get.id'));
            $result = [
                'title' => '系统功能管理-编辑',
                'group_list' => $group_list,
                'funt_one' => $funt_one
            ];
            $this->assign($result);
            $this->display();
        }
    }

    /*系统功能管理-删除*/
    public function delete(){
        \Admin\Model\FunctionModel::deletes(I('get.id'));
        redirect(U('Function/lists'));
    }


}