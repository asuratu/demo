<?php

namespace App\Handler\Admin\Structure\Series;

if (!defined('IN_PX'))
    exit;

use App\Handler\Admin\AbstractCommon;

/**
 * 显示
 */
class SetDisplay extends AbstractCommon {

    public function processRequest(Array & $context) {
        echo($this->_setFieldStatus(explode(',', $_POST['id']),
            '`#@__@series`', 'is_display', 'series_id'));
    }

}
