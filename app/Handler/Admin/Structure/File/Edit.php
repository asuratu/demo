<?php

namespace App\Handler\Admin\Structure\File;

if (!defined('IN_PX'))
    exit;

use App\Handler\Admin\AbstractCommon;
use Phoenix\Support\MsgHelper;

/**
 * 修改
 */
class Edit extends AbstractCommon {

    public function processRequest(Array & $context) {

        $_POST['category_id'] = intval($_POST['category_id']);
        $_POST['file_name'] = trim($_POST['file_name']);
        $_POST['is_display'] = intval($_POST['is_display']);
        $_POST['sort'] = intval($_POST['sort']);
        $_POST['release_date'] = time();
        $_POST['file_id'] = $_POST['id'];

        $_return = $this->db->table('`#@__@file`')
            ->row(array(
                '`category_id`' => '?',
                '`file_name`' => '?',
                '`file_url`' => '?',
                '`is_display`' => '?',
                '`sort`' => '?',
                '`release_date`' => '?',
                '`language`' => '?'
            ))
            ->where('`file_id` = ?')
            ->bind($_POST)
            ->update();

        echo(MsgHelper::json($_return ? 'SUCCESS' : ($_return == 0 ? 'NO_CHANGES' : 'DB_ERROR')));
    }

}
