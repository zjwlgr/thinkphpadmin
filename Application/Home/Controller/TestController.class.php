<?php
namespace Home\Controller;

class TestController extends CommonController {


    /*
         *
         * Oss
         * 上传 功能 测试
         *
         * */
    public function osstest(){

        $filesrc = $this->uploadfile($_FILES['image']);

        echo $filesrc;

        $this->display();
    }

    public function uploadfile($files,$imaup = ''){
        if(empty($files["name"])){
            $imagesrc = $imaup;
        }else{
            $Oss = new \Think\Oss();
            $parameter = array(
                'maxSize'	=> 2000000,
                'exts'		=> array('jpg', 'gif', 'png', 'jpeg'),
                'filepath'	=> 'xxjijuhyu/'.date('Y-m',time()).'/'
            );
            $result = $Oss->upload($files,$parameter);
            if($result['code'] == 1){
                $imagesrc = $result['src'];
                if(!empty($imaup)){$Oss->delete($imaup);}//删除旧文件
            }else{
                $this->error($result['msg']);
            }
        }
        return $imagesrc;
    }

    public function onedel(){
        $imaup = 'http://img.kuaxue.com/liveteache/2015-08/01E00280E4054E3C77C0BCA1180052A0.jpg';
        $Oss = new \Think\Oss();
        $Oss->delete($imaup);
    }

    // 删除所有 object - 绑定域名 - 修改代码并更新 - 下载旧图片信息 - 上传旧图片信息到Oss - 替换数据表中的旧图片URL为OssURL
}