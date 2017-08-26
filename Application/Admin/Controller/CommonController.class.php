<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

    public $manager_sess = '';

    public function _initialize(){
        if(!session('?manager')){//如果session未设置
            redirect(U('Login/index'));
        }else{
            $this->manager_sess = session('manager');
            $this->judge();//判断当前管理员对当前URL的权限
            $manager_sess = $this->manager_sess;//为属性赋值
            $manager_sess['group_name'] = $this->getGname($manager_sess['group_id']);//管理组名称
            $manager_sess['funclist'] =  $this->getFunclist();//管理左侧功能列表
            $this->assign('manager_sess',$manager_sess);//模板中所用数据
            layout('Layout/main');//默认布局
        }
    }

    /* 获取用户所在管理组名称
     * @param $id 管理组ID
     * @return String
     * */
    public function getGname($id){
        $result = \Admin\Model\ManagerGroupModel::getOne($id);
        return $result['gname'];
    }

    /* 获取用户所在管理组名称
     * @return Array
     * */
    public function getFunclist(){
        $user = $this->manager_sess;
        $manager = \Admin\Model\ManagerModel::getOne($user['id']);

        if($manager['group_id'] == 1){//超级管理员功能列表

            $group_list = \Admin\Model\FunctionModel::getGroupList(0,true);
            foreach($group_list as $key => $val){
                $funt_list = \Admin\Model\FunctionModel::getGroupList($val['id'],true);
                $group_list[$key]['funt_list'] = $funt_list;
            }

        }else{//权限管理员功能列表

            $group = \Admin\Model\ManagerGroupModel::getOne($manager['group_id']);
            $function_ar = json_decode($group['function'],true);
            foreach($function_ar as $key => $val){
                $key_ar[] = $key;
                foreach($val as $ke => $va){
                    $val_ar[] = $va;
                }
            }
            $key_str = implode(',',$key_ar);//父功能ID
            $val_str = implode(',',$val_ar);//子功能ID
            $group_list = \Admin\Model\FunctionModel::getGroupList(0,true,$key_str);
            foreach($group_list as $key => $val){
                $funt_list = \Admin\Model\FunctionModel::getGroupList($val['id'],true,$val_str);
                $group_list[$key]['funt_list'] = $funt_list;
            }

        }
        return $group_list;
    }

    /*判断非超级管理员是否有权限操作当前页面*/
    public function judge(){
        $user = $this->manager_sess;
        if($user['group_id'] == 1) {
            //超级管理员无需检查
        }else{
            $url = CONTROLLER_NAME.'/'.ACTION_NAME;
            if($url != 'Index/index') {//系统信息首页 所有用户默认可查看
                $furi = \Admin\Model\FunctionModel::getUriOne($url);//查询功能列表中对应记录
                if (empty($furi)) {
                    //查询结果为空暂不处理
                } else {
                    $group = \Admin\Model\ManagerGroupModel::getOne($user['group_id']);
                    $function_ar = json_decode($group['function'], true);
                    foreach ($function_ar as $key => $val) {
                        foreach ($val as $ke => $va) {
                            $val_ar[] = $va;
                        }
                    }
                    if (in_array($furi[0]['id'], $val_ar)) {
                        //如果功能ID存在当前管理员用户组中 无操作
                    } else {
                        $this->error('您没有该页面的操作权限！');
                    }
                }
            }
        }
    }

    /*左侧功能列表 ajax 搜索功能*/
    public function ajaxLeft(){
        layout(false);//关闭布局
        $search = I('post.search');
        $result = \Admin\Model\FunctionModel::search($search);//搜索子功能
        foreach($result as $key => $val){
            $funtid[] = $val['id'];
        }
        if(!empty($funtid)){//如果搜索结果不为空
            $funtid = implode(',',$funtid);//得到子功能ID，ID
            $parendid = \Admin\Model\FunctionModel::parentid($funtid);
            $parid = [];
            foreach($parendid as $key => $val){
                $parid[] = $val['fid'];
            }
            $parid = implode(',',$parid);//得到父功能ID，ID
            $group_list = \Admin\Model\FunctionModel::getGroupList(0,true,$parid);
            foreach($group_list as $key => $val){
                $funt_list = \Admin\Model\FunctionModel::getGroupList($val['id'],true,$funtid);
                $group_list[$key]['funt_list'] = $funt_list;
            }
        }else{
            $group_list = array();
        }
        $this->assign(['group_list' => $group_list, 'search'  => $search]);
        $this->show($this->fetch('Function/ajaxleft'));
    }











}
