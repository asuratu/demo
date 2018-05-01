<?php

namespace App\Handler\Admin\Structure\File;

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

        $_POST['category_id'] = intval($_POST['category_id']);
        $_POST['file_name'] = trim($_POST['file_name']);
        $_POST['is_display'] = intval($_POST['is_display']);
        $_POST['sort'] = intval($_POST['sort']);
        $_POST['release_date'] = time();

        $this->db->debug();
        $_identity = $this->db->table('`#@__@file`')
            ->row(array(
                '`category_id`' => '?',
                '`file_name`' => '?',
                '`file_url`' => '?',
                '`is_display`' => '?',
                '`sort`' => '?',
                '`release_date`' => '?',
                '`language`' => '?'
            ))
            ->bind($_POST)
            ->save();

        echo(MsgHelper::json($_identity ? 'SUCCESS' : 'DB_ERROR'));
    }

}
