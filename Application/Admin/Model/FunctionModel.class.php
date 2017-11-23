<?php
namespace Admin\Model;
use Think\Model;
class FunctionModel extends Model {

    protected $tableName = 'function';

    /*返回实例化的当前类到静态方法*/
    public static function tab(){
        $tab = new FunctionModel();
        return $tab;
    }

    /* 新增功能或功能组
     * @param $post 功能表单数据
     * @return Boolean
     * */
    public static function adds($post){
        if($post['fid'] == 0){//新增功能组
            $function = self::tab();
            $function->create();
            $function->fid = $post['fid'];
            $function->fname = $post['fidname'];
            $function->furi = 'none';
            $function->ctime = time();
            $insert_id = $function->add();
            $post['fid'] = $insert_id;
        }
        $function = self::tab();
        $function->create();
        $function->fid = $post['fid'];
        $function->fname = $post['fname'];
        $function->furi = $post['furi'];
        $function->ctime = time();
        $result = $function->add();
        return $result;
    }

    /* 编辑功能或功能组
     * @param $post 功能表单数据
     * @return Boolean
     * */
    public static function up($post){
        $function = self::tab();
        $function->create();
        $function->id = $post['id'];
        $function->fid = isset($post['fid']) ? $post['fid'] : 0;
        $function->fname = $post['fname'];
        $function->furi = $post['furi'];
        $function->sort = $post['sort'];
        $function->state = $post['state'];
        $function->save();
        return true;
    }

    /* 查询功能组列表
     * @param $state 控制是否显示被隐藏的
     * @param $idin 功能组IDS
     * @return Array 功能组列表
     * */
    public static function getGroupList($fid = 0,$state = false,$idin = false){
        $where = "fid = '$fid'";
        if($state) {
            $where .= " and state = 0";
        }
        if(!empty($idin)){
            $where .= " and id in($idin)";
        }
        $list = self::tab()
            ->where($where)
            ->field('id,fid,fname,furi,sort,candel,state,ctime')
            ->order('sort asc')
            ->select();
        return $list;
    }

    /* 搜索子功能（fid<>0 为子功能）
     * @param $keyword 关键字
     * @return Array 搜索结果集合
     * */
    public static function search($keyword){
        $list = self::tab()
            ->where("fid<>'0' and fname like '%$keyword%'")
            ->field('id')
            ->select();
        return $list;
    }

    /* 通过子功能ID，查询父功能IDS
     * @param $childid 子功能ID
     * @return Array
     * */
    public static function parentid($childid){
        $list = self::tab()
            ->where("id in($childid)")
            ->field('fid')
            ->select();
        return $list;
    }

    /* 根据FURI查询一条数据
     * @param $url 处理过的URL
     * @return Array
     * */
    public static function getUriOne($url){
        $one = self::tab()
            ->where("furi='$url'")
            ->field('id,furi')
            ->find();
        return $one;
    }

    /* 根据ID查询一条数据
     * @param $id 功能ID
     * @return Array
     * */
    public static function getOne($id){
        $one = self::tab()
            ->where("id='$id'")
            ->find();
        return $one;
    }

    /*删除功能组或功能*/
    public static function deletes($id){
        $funt_one = self::getOne($id);
        if($funt_one['candel'] == 0) {
            self::tab()->delete($id);
        }
    }

}