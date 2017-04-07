<?php
namespace Admin\Controller;

class ManagerGroupController extends CommonController {

    /*管理员分组-列表*/
    public function lists(){
        $search = I('get.search');
        $result = \Admin\Model\ManagerGroupModel::getList(20,$search);
        $result['title'] = '管理员分组管理-列表';
        $this->assign($result);
        $this->display();
    }

    /*管理员分组-新增*/
    public function add(){
        if(IS_POST){
            $ManagerGroupInfo = I('post.ManagerGroupInfo');
            $result = \Admin\Model\ManagerGroupModel::adds($ManagerGroupInfo);
            if($result){
                $this->success('管理员分组新增成功！',U('ManagerGroup/lists'));
            }
        }else{
            $func_list = \Admin\Model\FunctionModel::getGroupList(0,true);
            foreach($func_list as $key => $val){
                $f_list = \Admin\Model\FunctionModel::getGroupList($val['id'],true);
                $func_list[$key]['f_list'] = $f_list;
            }
            $count = \Admin\Model\ManagerGroupModel::counts();
            $data = [
                'title' => '管理员分组管理-新增',
                'func_list' => $func_list,
                'count' => $count,
            ];
            $this->assign($data);
            $this->display();
        }
    }

    /*管理员分组-编辑*/
    public function up(){
        $id = I('get.id');
        if(IS_POST){
            $ManagerGroupInfoPost = I('post.ManagerGroupInfo');
            $result = \Admin\Model\ManagerGroupModel::up($ManagerGroupInfoPost);
            if($result){
                $this->success('管理员分组编辑成功！',U('ManagerGroup/lists'));
            }
        }else{
            $func_list = \Admin\Model\FunctionModel::getGroupList(0,true);
            foreach($func_list as $key => $val){
                $f_list = \Admin\Model\FunctionModel::getGroupList($val['id'],true);
                $func_list[$key]['f_list'] = $f_list;
            }
            $count = \Admin\Model\ManagerGroupModel::counts();
            $group_one = \Admin\Model\ManagerGroupModel::getOne($id);

            $func_ar = json_decode($group_one['function'],true);
            foreach($func_ar as $key => $val){
                foreach($val as $ke => $va){
                    $new_ar[$va] = $va;
                }
            }//$new_ar 得到这个数组 可以在编辑时还原权限选中
            $data = [
                'title' => '管理员分组管理-编辑',
                'func_list' => $func_list,
                'count' => $count,
                'group_one' => $group_one,
                'newar' => $new_ar
            ];
            $this->assign($data);
            $this->display();
        }
    }

    /*管理员分组-删除*/
    public function delete(){
        $id = I('get.id');
        if($id != 1) {//超级管理员 不能被删除
            \Admin\Model\ManagerGroupModel::deletes($id);
        }
        redirect(U('ManagerGroup/lists'));
    }
}