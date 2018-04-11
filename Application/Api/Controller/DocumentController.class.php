<?php
namespace Api\Controller;

class DocumentController extends \Think\Controller  {
	
    public function index(){
        $cookie = cookie('API_UserName');
        if(empty($cookie)){
            header('Location: '.U("login"));exit;
        }

        $nowurl = $_SERVER['HTTP_HOST'];

        $this->cookie = $cookie;
        $api_document = M("api_document");
        $types = C('APITYPE');
        $type = I('get.type','1');// API类别
        $list = $api_document->where("type='$type'")->order("sort asc")->select();
        foreach($list as $key => $val){
            $kk = $key+1;
            $list[$key][key] = strlen($kk) == 1 ? '0'.$kk : $kk;//序号

            $content = str_replace("http://","http:\\\\",$val[content]);
            //$content = str_replace("//","=>",$content);
            $content = str_replace("http:\\\\","http://",$content);

            $content = str_replace("}","<span class='dakuoh'>}</span>",$content);
            $content = str_replace("{","<span class='dakuoh'>{</span>",$content);
            $content = str_replace("[","<span class='xakuoh'>[</span>",$content);
            $content = str_replace("]","<span class='xakuoh'>]</span>",$content);
            $content = str_replace("成功返回：","<span class='ziti'>成功返回：</span>",$content);
            $content = str_replace("失败返回：","<span class='ziti'>失败返回：</span>",$content);

            $content = preg_replace('/地址：(.*)\n/iU','<span class="ziti">地址：${1}</span>',$content);
            $content = preg_replace('/方式：(.*)\n/iU','<span class="ziti">方式：${1}</span>',$content);
            $content = preg_replace('/参数：(.*)\n/iU','<span class="ziti">参数：${1}</span>',$content);
            $content = preg_replace('/例子：(.*)\n/iU','<span class="ziti">例子：<a href="${1}" class="zitia"  target="_blank">${1}</a></span>',$content);
            $content = preg_replace('/测试：(.*)\n/iU','<span class="ziti">测试：<a href="${1}" class="zitia"  target="_blank">${1}</a></span>',$content);

            $content = preg_replace("/\"(.*)\":/iU",'<span class="jianmin">"${1}"</span>:',$content);
            $content = preg_replace("/:(.*),/iU",':<span class="jianzhi">${1}</span>,',$content);
            $content = preg_replace("/<\\/span>:(.*)\n/iU",'</span>:<span class="jianzhi">${1}</span>',$content);
            $content = preg_replace("/=>(.*)<\\/span>/iU",'<span class="zhushi">&nbsp;&nbsp;//${1}</span></span>',$content);

            $content = str_replace("*","<span class='xinxin'>*</span>",$content);

            $content = str_replace("tokenzjwlgrtoken",sha1(md5(date("YmdHi").'&%@$Xi768')),$content);

            if($nowurl == 'api.lianbi.c'){
                $content = str_replace("https://api.lianbi.io",'http://'.$nowurl,$content);
            }

            $list[$key][content] = $content;
        }
        $this->list = $list;
        $this->typename = $types[$type];
        $this->typelist = $types;
        $this->type = $type;
        $this->display();
    }

    public function login_action(){
        if(!empty($_POST)){
            $username = trim(I("post.username"));
            $password = trim(I("post.password"));

            $Uarr = array('zjwlgr','loushixiao','xieqingqing','pengfei','zhangyunfei','liuzhihua');
            $Pstr = '123456';

            if (in_array($username,$Uarr) && $password == $Pstr){
                $data["error"] = 1;
                $data["username"] = $username;
                $data["url"] = U('index');
                cookie('API_UserName',$data,3600*24*365);
            }else{
                $data["error"] = 0;
                $data["msg"] = "登录失败！用户名或密码有误！";
            }
            $this->ajaxReturn($data);
        }else{
            $this->display();
        }
    }//登录操作

    public function loginout(){
        cookie('API_UserName',null);
        header('Location: '.U("login"));
    }//退出操作

}