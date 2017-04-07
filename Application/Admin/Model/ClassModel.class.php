<?php
namespace Admin\Model;
use Think\Model;
class ClassModel extends Model {

    protected $tableName = 'class';

    /*返回实例化的当前类到静态方法*/
    public static function tab(){
        $tab = new ClassModel();
        return $tab;
    }

    /* 新增分类
     * @param $post 表单数据
     * @return Array
     * */
    public static function adds($post){
        $one = self::one($post['fid']);
        $data = [
            'fid' => $post['fid'],
            'nexus' => $one['nexus'].$post['nexus'],
            'depth' => $post['depth'],
            'name' => $post['name'],
            'ctime' => time(),
        ];
        $post['id'] = $ClassInfo = self::tab()->data($data)->add();
        return $post;
    }

    /* 通过ID 查询某一条数据
     * @param $id 表单数据
     * @return Array
     * */
    public static function one($id){
        $ClassInfo = self::tab()
            ->where(['id' => $id])
            ->find();
        return $ClassInfo;
    }

    /*通过NAME 查询某一条数据 id,fid,name 前台导航选中*/
    public static function name_one($name){
        $ClassInfo = self::tab()
            ->field('id,fid,name')
            ->where(['name' => $name])
            ->find();
        return $ClassInfo;
    }

    /*通过ID 查出 分类 名称 name*/
    public static function classnames($id){
        $result = self::tab()
            ->where(['id' => $id])
            ->getField('name');
        return $result;
    }

    /*通过 FID 查询一个父下面子分类的集合*/
    public static function lists($fid,$count=false){
        $ClassInfo = self::tab()
            ->where(['fid' => $fid])
            ->order('sort DESC,id ASC')
            ->select();
        if($count){//是否需要子类 的子类总数
            foreach($ClassInfo as $key => $val){
                $ClassInfo[$key]['count'] = self::total($val['id']);
            }
        }
        return $ClassInfo;
    }

    /*通过 FID 查询子分类总数*/
    public static function total($fid){
        $ClassInfo = self::tab()
            ->where(['fid' => $fid])
            ->count();
        return $ClassInfo;
    }

    /*通过ID 删除分类与所有级的子分类*/
    public static function deletes($id){
        self::tab()->where('FIND_IN_SET('.$id.',nexus)')->delete();
        self::tab()->delete($id);
    }

    /*编辑分类信息*/
    public static function updates($post){
        $data['id'] = $post['id'];
        if(!empty($post['name'])) {
            $data['name'] = $post['name'];
        }
        if(!empty($post['sort'])) {
            $data['sort'] = $post['sort'];
        }
        self::tab()->data($data)->save();
        return true;
    }

    /*通过 FID 查询一个父下面子分类的集合 只 id,name 前台导航
    * $type 为是否查询Swift分类
    */
    /*
    public static function list_field($fid,$type=true){
        $ClassInfo = self::tab()
            ->field('id,name')
            ->where(['fid' => $fid]);
        if($type) {
            $ClassInfo->where(['id' => ['NEQ', 160]]);
        }
        $ClassInfo = $ClassInfo->order('sort DESC,id ASC')->select();
        return $ClassInfo;
    }*/

    /*列出主分类 下面所有子分类中 子分类信息 前台右侧分类*/
    /*
    public static function get_child(){
        $class_list = self::list_field(135,false);
        $child_list = array();
        foreach($class_list as $key => $val){
            $child_list = array_merge($child_list,self::list_field($val['id']));
        }
        return $child_list;
    }*/

}