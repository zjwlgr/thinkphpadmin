<?php
namespace Admin\Model;
use Think\Model;
class ManagerModel extends Model {

    protected $tableName = 'manager';

    /*返回实例化的当前类到静态方法*/
    public static function tab(){
        $tab = new ManagerModel();
        return $tab;
    }

    /* 后台管理员登录
     * @param $post 用户提交的数据
     * @return Array
     * */
    public static function login($post){
        if(self::tab()->autoCheckToken($post) == false){return ['token' => 'no'];}//手动验证令牌
        $manager = $post['ManagerInfo'];
        $rows = self::tab()
            ->where(['username' => $manager['username']])
            ->field("id,username,password,uname,number,group_id,locking")
            ->find();
        return $rows;
    }

    /* 更新次数、ip、登录时间
     * @param $id 表ID
     * @param $number 上一次的登录次数
     * @return Void
     * */
    public static function setData($id,$number){
        self::tab()->data([
            'id' => $id,
            'number' => $number + 1,
            'login_ip' => get_client_ip(),
            'login_time' => time()
        ])->save();
    }

    /* 根据ID获取管理员一条信息
     * @param $id 表ID
     * @return Array
     * */
    public static function getOne($id){
        $one = self::tab()->where(['id' => $id])->find();
        return $one;
    }

    /* 管理员修改密码处理
     * @param $post
     * @return Boolean
     * */
    public static function editpwd($post){
        $one = self::tab()
            ->where(['id' => $post['id'], 'password' => md5($post['oldpassword'])])
            ->find();
        if(!empty($one)) {
            self::tab()
                ->data(['id' => $post['id'], 'password' => md5($post['password'])])
                ->save();
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    /* 管理员管理-列表
     * @param $pageSize 每页的记录数
     * @param $page 每页的记录数 隐含 $_GET[p]
     * @param $search 搜索关键字
     * @param $group_id 管理员分组ID
     * @return Array 结果集
     * */
    public static function getList($pageSize, $search, $group_id){
        $where = '1=1';
        if(!empty($search)){
            $where .= " and (username like '%$search%' or uname like '%$search%')";
        }
        if(!empty($group_id)){
            $where .= " and group_id='$group_id'";
        }
        $count = self::tab()->where($where)->count();
        $Page = new \Think\PageBootstrap($count,$pageSize);
        $show = $Page->show();
        $list = self::tab()->where($where)->field('id,username,uname,group_id,locking,number,login_ip,login_time,ctime')->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        return ['list' => $list, 'page' => $show, 'count' => $count];
    }

    /* 删除管理员列表
     * @param $id 管理员ID
     * @return Void
     * */
    public static function deletes($id){
        self::tab()->delete($id);
    }

    /*查询当前模块表数据总数*/
    public static function counts(){
        $count = self::tab()->count();
        return $count;
    }

    /* 编辑管理员时验证管理员是否已存在
     * @param $username 管理员用户名
     * @param $id 当前用户ID，一般用于编辑更改用户时
     * @return Array 重复的管理员信息
     * */
    public static function check_username($username,$id=''){
        $where['username'] = $username;
        if(!empty($id)){
            $where['id'] = ['NEQ',$id];
        }
        $resutl = self::tab()->where($where)->find();
        return $resutl;
    }

    /* 新增管理员操作
     * @param $post 管理员数据
     * @return Boolean
     * */
    public static function adds($post){
        $check_user = self::check_username($post['username']);
        if(empty($check_user)) {
            $ManagerInfo = self::tab();
            $ManagerInfo->create();
            $ManagerInfo->username = $post['username'];
            $ManagerInfo->password = md5($post['password']);
            $ManagerInfo->uname = $post['uname'];
            $ManagerInfo->group_id = $post['group_id'];
            $ManagerInfo->locking = $post['locking'];
            $ManagerInfo->ctime = time();
            $result = $ManagerInfo->add();
        }else{
            $result = false;
        }
        return $result;
    }

    /* 编辑管理员操作
     * @param $post 管理员数据
     * @return Boolean
     * */
    public static function up($post){
        $check_user = self::check_username($post['username'],$post['id']);
        if(empty($check_user)) {
            $ManagerInfo = self::tab();
            $ManagerInfo->create();
            $ManagerInfo->id = $post['id'];
            $ManagerInfo->username = $post['username'];
            if (!empty($post['password'])) {
                $ManagerInfo->password = md5($post['password']);
            }
            $ManagerInfo->uname = $post['uname'];
            $ManagerInfo->group_id = $post['group_id'];
            $ManagerInfo->locking = $post['locking'];
            $ManagerInfo->save();
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

}