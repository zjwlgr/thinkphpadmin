<?php
namespace Admin\Controller;

class DocumentController extends CommonController {

    public function index(){}

    public function  add_document(){
        $api_document = M("api_document");
        $type = C('APITYPE');
        $this->type = $type;
        $this->count = $api_document->count();
        $this->title = "新增API";
        $this->display();
    }

    public function add_action(){
        $api_document = M("api_document");
        $api_document->create();
        $api_document->content = I('post.content','',false);
        $api_document->ctime = time();
        $api_document->add();
        $this->success("添加成功",U('add_document'));
    }

    public function tp_document(){
        $api_document = M("api_document");


        $type = I('get.type','1');

        $list = $api_document->where("type='$type'")->order("sort asc")->select();


        $types = C('APITYPE');
        $this->types = $types;
        $this->type = $type;
        $this->count = $api_document->count();
        $this->list = $list;
        $this->title = '链币API文档管理';
        $this->display();
    }

    public function up_document(){
        $api_document = M("api_document");
        $id = I('get.id');
        $typeg = I('get.type');
        $type = C('APITYPE');
        $this->type = $type;
        $this->typeg = $typeg;
        $this->count = $api_document->count();
        $list = $api_document->where("id='$id'")->find();
        $this->title = '编辑API';
        $this->list = $list;$this->display();
    }

    public function up_action(){

        $api_document = M("api_document");
        $api_document->create();
        $api_document->content = I('post.content','',false);
        $api_document->save();
        $this->success("编辑成功",U('tp_document?type='.I('post.typeg')));
    }

    public function del_un(){
        $Unction = M('api_document');
        $id = I('get.id');
        $Unction->delete($id);
        $this->success("操作成功");
    }


}