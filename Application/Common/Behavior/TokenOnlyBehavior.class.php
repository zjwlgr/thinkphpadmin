<?php
namespace Common\Behavior;
use Behavior\TokenBuildBehavior;
/**
 * 只返回生成的表单令牌
 */
class TokenOnlyBehavior extends TokenBuildBehavior {
    public function run(&$content){
        $this->buildToken($content);
    }
// 创建表单令牌
    private function buildToken(&$content) {
        $tokenName = C('TOKEN_NAME');
        //$tokenType = C('TOKEN_TYPE');
        if(!isset($_SESSION[$tokenName])) {
            $_SESSION[$tokenName] = array();
        }
// 标识当前页面唯一性
        $tokenKey = md5($_SERVER['REQUEST_URI']);
        if(isset($_SESSION[$tokenName][$tokenKey])) {// 相同页面不重复生成session
            $tokenValue = $_SESSION[$tokenName][$tokenKey];
        }else{
            $tokenValue = md5(microtime(TRUE));
            $_SESSION[$tokenName][$tokenKey] = $tokenValue;
        }
        $content = $tokenKey.'_'.$tokenValue;
    }
}