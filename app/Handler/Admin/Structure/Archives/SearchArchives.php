<?php

namespace App\Handler\Admin\Structure\Archives;

use App\Handler\Admin\AbstractCommon;
use App\Tools\Auxi;
use App;
use Phoenix\Log\Log4p;
use Phoenix\Support\MsgHelper;

if (!defined('IN_PX'))
    exit;
/**
 * Date: 2016/10/11 0012
 * Time: 下午 14:29
 */
class SearchArchives extends AbstractCommon {

    public function processRequest(Array & $context)
    {
        $_POST['key'] = trim($_POST['key']);
//        $_POST['archives_id'] = (int)$_POST['archives_id'];

        $_where = '0 = 0';
        $_bindParam = array();
        if(isset($_POST['key']) && $_POST['key'] != ''){
            $_where .= ' AND (CONCAT_WS(\'\', f.`file_name`) LIKE :key )';
            $_bindParam[':key'] = '%' . $_POST['key'] . '%';
        }
        $files_list =  $this->db->select('f.*')
            ->table('`#@__@file` f')
            ->where($_where)
            ->bind($_bindParam)
            ->order('f.`sort`')
            ->findAll();

        echo(MsgHelper::json('SUCCESS', '数据返回成功', array('rs' => $files_list)));
    }
}