<?php

namespace App\Handler\Admin\Structure\Recruit;

if (!defined('IN_PX'))
    exit;

use App\Handler\Admin\AbstractCommon;
use Phoenix\Support\MsgHelper;

/**
 * 添加
 *
 */
class Add extends AbstractCommon {

    public function processRequest(Array & $context) {
        $this->_pushSetting();

        //$this->db->debug();
        $_POST['position'] = trim($_POST['position']);
        $_POST['is_display'] = intval($_POST['is_display']);
        $_POST['sort'] = intval($_POST['sort']);
        $_POST['release_date'] = time();

        $this->db->debug();
        $_identity = $this->db->table('`#@__@recruit`')
            ->row(array(
                '`position`' => '?',
                '`is_display`' => '?',
                '`sort`' => '?',
                '`desc`' => '?',
                '`requ`' => '?',
                '`release_date`' => '?',
                '`language`' => '?'
            ))
            ->bind($_POST)
            ->save();

        echo(MsgHelper::json($_identity ? 'SUCCESS' : 'DB_ERROR'));
    }

}
