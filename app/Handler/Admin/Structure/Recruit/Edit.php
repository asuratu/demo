<?php

namespace App\Handler\Admin\Structure\Recruit;

if (!defined('IN_PX'))
    exit;

use App\Handler\Admin\AbstractCommon;
use Phoenix\Support\MsgHelper;

/**
 * 修改
 */
class Edit extends AbstractCommon {

    public function processRequest(Array & $context) {

        $_POST['position'] = trim($_POST['position']);
        $_POST['is_display'] = intval($_POST['is_display']);
        $_POST['sort'] = intval($_POST['sort']);
        $_POST['release_date'] = time();
        $_POST['recruit_id'] = $_POST['id'];

        $this->db->debug();
        $_return = $this->db->table('`#@__@recruit`')
            ->row(array(
                '`position`' => '?',
                '`is_display`' => '?',
                '`sort`' => '?',
                '`desc`' => '?',
                '`requ`' => '?',
                '`release_date`' => '?',
                '`language`' => '?'
            ))
            ->where('`recruit_id` = ?')
            ->bind($_POST)
            ->update();

        echo(MsgHelper::json($_return ? 'SUCCESS' : ($_return == 0 ? 'NO_CHANGES' : 'DB_ERROR')));
    }

}
