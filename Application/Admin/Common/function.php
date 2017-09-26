<?php
/*后台按分类查看设置选中状态*/
function v_v($is1,$is2){
    if($is2 === 0){
        if(isset($is1) && $is2 == $is1){
            return 'text-primary';
        }else {
            return 'text-muted';
        }
    }else {
        if ($is1 == $is2) {
            return 'text-primary';
        } else {
            return 'text-muted';
        }
    }
}