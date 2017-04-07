<?php
return array(
    'view_filter' => array('Behavior\TokenBuildBehavior'),
    //令牌验证功能，可以有效防止表单的重复提交等安全防护
    'create_token' => array('Common\Behavior\TokenOnlyBehavior'),
    //自己创建令牌，用于Ajax返回
);