<?php
namespace Admin\Model;
use Think\Model;
class ManagerRecordModel extends Model {

    protected $tableName = 'manager_record';

    /*返回实例化的当前类到静态方法*/
    public static function tab(){
        $tab = new ManagerRecordModel();
        return $tab;
    }

    /* 添加管理员登录信息，ip，时间，浏览器，系统
     * @param $array 管理员的基本信息
     * @return Int 返回记录ID
     * */
    public static function insert($array){
        $result = self::tab()->data([
            'user_id'  => $array['id'],
            'username' => $array['username'],
            'uname'    => $array['uname'],
            'ip'       => get_client_ip(),
            'time'     => time(),
            'browser'  => determinebrowser(),
            'system'   => determineplatform()
        ])->add();
        return $result;
    }

    /* 管理员登录日志-列表
     * @param $pageSize 每页的记录数
     * @param $page 每页的记录数   隐含 $_GET[p]
     * @param $search 搜索关键字
     * @return Array 结果集
     * */
    public static function getList($pageSize, $search){
        $where = '';
        if(!empty($search)){
            $where = "a.username like '%$search%' or a.uname like '%$search%'";
        }
        $count = self::tab()->where(str_replace('a.','',$where))->count();
        $Page = new \Think\PageBootstrap($count,$pageSize);
        $show = $Page->show();
        $list = self::tab()->join(" a left join __MANAGER__ b on a.user_id=b.id")->where($where)->field('a.id,a.user_id,a.username,a.uname,a.ip,a.time,a.browser,a.system,b.number')->order('a.id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        return ['list' => $list, 'page' => $show, 'count' => $count];
    }

    /* 根据ID删除记录
     * @param $id 记录ID
     * @return Int 删除的记录数
     * */
    public static function deletes($id){
        $result = self::tab()->delete($id);
        //delete方法的返回值是删除的记录数，如果返回值是false则表示SQL出错，返回值如果为0表示没有删除任何数据
        return $result;
    }

    /* 根据user_id删除记录
     * @param $user_id 管理员ID
     * @return Int 删除的记录数
     * */
    public static function deletes_user($user_id){
        $result = self::tab()->where(['user_id' => $user_id])->delete();
        return $result;
    }

}