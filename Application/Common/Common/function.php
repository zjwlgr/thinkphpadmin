<?php
/*截取字符串*/
function subtitle($String,$Length,$dian="") {
    if (mb_strwidth($String, 'UTF8') <= $Length ){
        return $String;
    }else{
        $I = 0;
        $len_word = 0;
        while ($len_word < $Length){
            $StringTMP = substr($String,$I,1);
            if ( ord($StringTMP) >=224 ){
                $StringTMP = substr($String,$I,3);
                $I = $I + 3;
                $len_word = $len_word + 2;
            }elseif( ord($StringTMP) >=192 ){
                $StringTMP = substr($String,$I,2);
                $I = $I + 2;
                $len_word = $len_word + 2;
            }else{
                $I = $I + 1;
                $len_word = $len_word + 1;
            }
            $StringLast[] = $StringTMP;
        }
        /* raywang edit it for dirk for (es/index.php)*/
        if (is_array($StringLast) && !empty($StringLast)){
            $StringLast = implode("",$StringLast);
            $StringLast .= $dian;
        }
        return $StringLast;
    }
}

/*base64 加密*/
function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

/*base64 解密*/
function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

/*获取访问用户的浏览器的信息*/
function determinebrowser () {
    $Agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (preg_match('/msie ([0-9].[0-9]{1,2})/',$Agent,$version)) {
        $browserversion=$version[1];
        $browseragent="Internet Explorer";
    } else if (preg_match( '#opera/([0-9]{1,2}.[0-9]{1,2})#',$Agent,$version)) {
        $browserversion=$version[1];
        $browseragent="Opera";
    } else if (preg_match( '#firefox/([0-9.]{1,5})#',$Agent,$version)) {
        $browserversion=$version[1];
        $browseragent="Firefox";
    }else if (preg_match( '#chrome/([0-9].{1,3})#',$Agent,$version)) {
        $browserversion=$version[1];
        $browseragent="Chrome";
    }else if (preg_match( '#safari/([0-9.]{1,3})#',$Agent,$version)) {
        $browseragent="Safari";
        $browserversion="";
    }else {
        $browserversion = "";
        $browseragent = $Agent;
    }
    return $browseragent." ".$browserversion;
}

/*获取访问用户的系统的信息*/
function determineplatform () {
    $Agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $browserplatform='';
    if (preg_match('/win/',$Agent) && strpos($Agent, '95')) {
        $browserplatform="Windows 95";
    }
    elseif (preg_match('/win 9x/',$Agent) && strpos($Agent, '4.90')) {
        $browserplatform="Windows ME";
    }
    elseif (preg_match('/win/',$Agent) && preg_match('/98/',$Agent)) {
        $browserplatform="Windows 98";
    }
    elseif (preg_match('/win/',$Agent) && preg_match('/nt 5.0/',$Agent)) {
        $browserplatform="Windows 2000";
    }
    elseif (preg_match('/win/',$Agent) && preg_match('/nt 5.1/',$Agent)) {
        $browserplatform="Windows XP";
    }
    elseif (preg_match('/win/',$Agent) && preg_match('/nt 6.0/',$Agent)) {
        $browserplatform="Windows Vista";
    }
    elseif (preg_match('/win/',$Agent) && preg_match('/nt 6.1/',$Agent)) {
        $browserplatform="Windows 7";
    }
    elseif (preg_match('/win/',$Agent) && preg_match('/32/',$Agent)) {
        $browserplatform="Windows 32";
    }
    elseif (preg_match('/win/',$Agent) && preg_match('/nt/',$Agent)) {
        $browserplatform="Windows NT";
    }elseif (preg_match('/mac os/',$Agent)) {
        $browserplatform="Mac OS";
    }
    elseif (preg_match('/linux/',$Agent)) {
        $browserplatform="Linux";
    }
    elseif (preg_match('/unix/',$Agent)) {
        $browserplatform="Unix";
    }
    elseif (preg_match('/sun/',$Agent) && preg_match('/os/',$Agent)) {
        $browserplatform="SunOS";
    }
    elseif (preg_match('/ibm/',$Agent) && preg_match('/os/',$Agent)) {
        $browserplatform="IBM OS/2";
    }
    elseif (preg_match('/mac/',$Agent) && preg_match('/pc/',$Agent)) {
        $browserplatform="Macintosh";
    }
    elseif (preg_match('/powerpc/',$Agent)) {
        $browserplatform="PowerPC";
    }
    elseif (preg_match('/aix/',$Agent)) {
        $browserplatform="AIX";
    }
    elseif (preg_match('/hpux/',$Agent)) {
        $browserplatform="HPUX";
    }
    elseif (preg_match('/netbsd/',$Agent)) {
        $browserplatform="NetBSD";
    }
    elseif (preg_match('/bsd/',$Agent)) {
        $browserplatform="BSD";
    }
    elseif (preg_match('/osf1/',$Agent)) {
        $browserplatform="OSF1";
    }
    elseif (preg_match('/irix/',$Agent)) {
        $browserplatform="IRIX";
    }
    elseif (preg_match('/freebsd/',$Agent)) {
        $browserplatform="FreeBSD";
    }
    if ($browserplatform=='') {$browserplatform = $Agent; }
    return $browserplatform;
}

/*判断是否是手机浏览器，如果是 返回 true*/
function ismobile() {
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))        return true;
    //此条摘自TPM智能切换模板引擎，适合TPM开发
    if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])        return true;
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
    //判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'        );
        //从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}