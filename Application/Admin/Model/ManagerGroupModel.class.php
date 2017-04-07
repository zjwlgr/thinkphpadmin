<?php
namespace Admin\Model;
use Think\Model;
class ManagerGroupModel extends Model {

    protected $tableName = 'manager_group';

    /*返回实例化的当前类到静态方法*/
    public static function tab(){
        $tab = new ManagerGroupModel();
        return $tab;
    }

    /* 根据ID返回管理组一条信息
     * @param $id 管理组ID
     * @return Array 管理组集合
     * */
    public static function getOne($id){
        $result = self::tab()->where(['id' => $id])->find();
        return $result;
    }

    /* 查询管理员分组列表
     * @return Array 管理组集合
     * */
    public static function selectList(){
        $result = self::tab()->field("id,gname")->select();
        return $result;
    }

    /* 管理员分组管理-列表
     * @param $pageSize 每页的记录数
     * @param $page 每页的记录数 隐含 $_GET[p]
     * @param $search 搜索关键字
     * @param $group_id 管理员分组ID
     * @return Array 结果集
     * */
    public static function getList($pageSize, $search){
        if(!empty($search)){
            $where = "gname like '%".$search."%'";
        }
        $count = self::tab()->where($where)->count();
        $Page = new \Think\PageBootstrap($count,$pageSize);
        $show = $Page->show();
        $list = self::tab()->where($where)->field('id,gname,function,ctime')->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        return ['list' => $list, 'page' => $show, 'count' => $count];
    }

    /* 新增管理员分组
     * @param $post 管理员分组数据
     * @return Boolean
     * */
    public static function adds($post){
        foreach($post['function'] as $val){
            $newar = explode('_',$val);
            $func_ar[$newar[0]][] = $newar[1];
        }
        $function_json = json_encode($func_ar);
        $ManagerGroup = self::tab();
        $ManagerGroup->create();
        $ManagerGroup->gname = $post['gname'];
        $ManagerGroup->function = $function_json;
        $ManagerGroup->ctime = time();
        $result = $ManagerGroup->add();
        return $result;
    }

    /* 编辑管理员分组
     * @param $post 管理员分组数据
     * @return Boolean
     * */
    public static function up($post){
        foreach($post['function'] as $val){
            $newar = explode('_',$val);
            $func_ar[$newar[0]][] = $newar[1];
        }
        $function_json = json_encode($func_ar);
        $ManagerGroup = self::tab();
        $ManagerGroup->create();
        $ManagerGroup->id = $post['id'];
        $ManagerGroup->gname = $post['gname'];
        $ManagerGroup->function = $function_json;
        $ManagerGroup->ctime = time();
        $ManagerGroup->save();
        return true;
    }

    /*查询当前模块表数据总数*/
    public static function counts(){
        $count = self::tab()->count();
        return $count;
    }

    /* 删除管理员列表
     * @param $id 管理员ID
     * @return Void
     * */
    public static function deletes($id){
        self::tab()->delete($id);
    }


}