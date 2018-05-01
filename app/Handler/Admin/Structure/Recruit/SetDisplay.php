<?php

namespace App\Handler\Admin\Structure\Recruit;

if (!defined('IN_PX'))
    exit;

use App\Handler\Admin\AbstractCommon;

/**
 * 修改
 */
class SetDisplay extends AbstractCommon {

    public function processRequest(Array & $context) {
        $this->_pushSetting();
        $_ary = explode(',', $_POST['id']);
        echo($this->_setFieldStatus($_ary, '`#@__@recruit`', 'is_display', 'recruit_id'));
    }

}
