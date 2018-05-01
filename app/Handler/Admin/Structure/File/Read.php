<?php

namespace App\Handler\Admin\Structure\File;

if (!defined('IN_PX'))
    exit;

use App\Handler\Admin\AbstractCommon;
use App\Admin\Helper;
use App\Tools\Auxi;
use Phoenix\Support\MsgHelper;

/**
 * 读取
 */
class Read extends AbstractCommon {

    public function processRequest(Array & $context) {
        $this->_pushSetting();

        if (!$_POST['sortName'])
            $_POST['sortName'] = 'f.file_id';
        if (!$_POST['sortOrder'])
            $_POST['sortOrder'] = 'ASC';

        if (!$_POST['page'])
            $_POST['page'] = 1;
        if (!$_POST['rp'])
            $_POST['rp'] = 10;
        $_start = (($_POST['page'] - 1) * $_POST['rp']);

        $_where = '0 = 0 AND f.`category_id` = c.`category_id`';
        $_bindParam = array();

        if (isset($_POST['sltLanguage'])) {
            $_where .= ' AND f.`language` = :sltLanguage';
            $_bindParam[':sltLanguage'] = $_POST['sltLanguage'];
        }

        if (isset($_POST['sltDateA']) && $_POST['sltDateA'] && $_POST['sltDateB']) {
            $_where .= ' AND (f.`release_date` BETWEEN :sltDateA AND :sltDateB)';
            $_bindParam[':sltDateA'] = $_POST['sltDateA'];
            $_bindParam[':sltDateB'] = $_POST['sltDateB'];
        }
        if (isset($_POST['strSearchKeyword']) && $_POST['strSearchKeyword'] != '') {
            $_where .= ' AND (f.`file_name` LIKE :strSearchKeyword)';
            $_bindParam[':strSearchKeyword'] = '%' . trim($_POST['strSearchKeyword']) . '%';
        }
//        if (isset($_POST['series_id']) && $_POST['series_id'] != '') {
//            $_where .= ' AND f.`series_id` = :series_id';
//            $_bindParam[':series_id'] = $_POST['series_id'];
//        }

        $_table = '`#@__@file` f, `#@__@category` c';
        $_total = $this->db->table($_table)->where($_where)->bind($_bindParam)->count();
        $this->db->debug();
        $_rs = $this->db->select('f.*, c.`category_name`, c.`id_tree`')
            ->table($_table)
            ->where($_where)
            ->order($_POST['sortName'], $_POST['sortOrder'])
            ->limit($_start, $_POST['rp'])
            ->bind($_bindParam)
            ->findAll();

        $_rsp = array(
            'totalResults' => $_total,
            'rows' => array()
        );
        if ($_total) {
            foreach ($_rs as $m) {
                $_idValue = $m->file_id;
                array_push($_rsp['rows'], array(
                    'id' => $_idValue,
                    'cell' => array(
                        $_idValue,
                        $m->id_tree,
                        $m->category_name,
                        $m->file_name,
                        '<span' . Auxi::getDeepColor(intval($m->is_display)) . '>'
                        . $this->setting['aryBool'][intval($m->is_display)] . '</span>',
                        $m->sort,
                        date('Y-m-d H:i:s', $m->release_date)
                    )
                ));
            }
        }
        echo(MsgHelper::json('SUCCESS', '数据返回成功', $_rsp));
    }

}
