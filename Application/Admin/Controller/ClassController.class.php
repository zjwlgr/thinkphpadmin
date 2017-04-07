<?php
namespace Admin\Controller;

class ClassController extends CommonController {


    public function index(){
        $list = \Admin\Model\ClassModel::lists(0,true);
        $count = \Admin\Model\ClassModel::total(0);
        $data = [
            'title' => '系统分类管理-列表',
            'count' => $count,
            'list' => $list,
        ];
        $this->assign($data);
        $this->display();
    }

    /*Ajax 添加分类*/
    public function add(){
        layout(false);//关闭布局
        $post = I('post.');
        $post['depth'] = $post['depth'] + 1;
        $post['nexus'] = '';
        if($post['depth'] > 1){
            $post['nexus'] = $post['fid'].',';
        }
        $result = \Admin\Model\ClassModel::adds($post);//入库
        $result['sort'] = 0;$result['count'] = 0;
        $this->assign('result',$result);
        echo $this->fetch('add');
    }

    /*Ajax 删除分类*/
    public function delete(){
        \Admin\Model\ClassModel::deletes(I('post.id'));
    }

    /*Ajax 编辑分类信息*/
    public function upclass(){
        $result = \Admin\Model\ClassModel::updates(I('post.'));
        return $result;
    }

    /*Ajax 展开分类*/
    public function updown(){
        layout(false);//关闭布局
        $list = \Admin\Model\ClassModel::lists(I('post.id'),true);
        $one = \Admin\Model\ClassModel::one(I('post.id'));
        $this->assign('list',$list);
        $this->assign('one',$one);
        echo $this->fetch('updown');
    }

}