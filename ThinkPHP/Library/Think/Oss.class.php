<?php
// +----------------------------------------------------------------------
// | TODO OSS Upload file class
// +----------------------------------------------------------------------
// | Author: ZJWLGR AND XINXIN
// +----------------------------------------------------------------------
namespace Think;
import('Think.sdk');

class Oss {

	public $off;
	const endpoint = OSS_ENDPOINT;
	const accessKeyId = OSS_ACCESS_ID;
	const accesKeySecret = OSS_ACCESS_KEY;
	const bucket = OSS_TEST_BUCKET;

	public function upload($file,$parameter){
		if(empty($file)){$this->off = array('code' => 0, 'msg' => '未发现可用文件'); return $this->off; exit;}
		$fileext = pathinfo($file['name'], PATHINFO_EXTENSION);//文件后缀
		$filename = strtoupper(md5(uniqid(rand()))).'.'.$fileext;//文件名
		$reexts = empty($parameter['exts']) ? true : in_array(strtolower($fileext), $parameter['exts']);//后缀合法
		if(!$reexts) {
			$this->off = array('code' => 0, 'msg' => '上传文件后缀不允许');
		}else if($file['size'] > $parameter['maxSize']){
			$this->off = array('code' => 0, 'msg' => '上传文件大小不符');
		}else{
			$oss = new \ALIOSS(self::accessKeyId, self::accesKeySecret, self::endpoint);
			$bucket = self::bucket;
			$object = $parameter['filepath'].$filename;
			$file_path = $file['tmp_name'];
			$options = array(
				\ALIOSS::OSS_FILE_UPLOAD => $file_path,
				'partSize' => 82428800,
			);
			$res = $oss->create_mpu_object($bucket, $object,$options);
			$new_res = $res->header;
			$info = $new_res[_info];
			if($info['http_code'] == 200){
				$imgsrc = str_replace("http://oss-cn-beijing.aliyuncs.com/kuaxuexx/","http://img.kuaxue.com/",$info['url']);
                $imgsrc = str_replace("http://oss-cn-beijing-internal.aliyuncs.com/kuaxuexx/","http://img.kuaxue.com/",$imgsrc);

				$this->off = array('code' => 1, 'src' => $imgsrc);
			}else{
				$this->off = array('code' => 0, 'msg' => '上传文件失败');
			}
		}
		return $this->off;
	}//上传文件到 oss

	public function delete($fileurl){
		$oss = new \ALIOSS(self::accessKeyId, self::accesKeySecret, self::endpoint);
		$bucket = self::bucket;
		$ossurl = 'http://img.kuaxue.com/';
		$fileurl = str_replace($ossurl,"",$fileurl);
		$object = $fileurl;
		$res = $oss->delete_object($bucket, $object);
		$new_res = $res->header;
		$info = $new_res[_info];
		//$info['http_code'] == 204 表标成功，成功与否不做判断
	}//所有的 object 都可以删除，包括 目录



}  
