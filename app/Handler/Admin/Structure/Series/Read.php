<?php

namespace App\Handler\Admin\Structure\Series;

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
            $_POST['sortName'] = 's.id_tree';
        if (!$_POST['sortOrder'])
            $_POST['sortOrder'] = 'ASC';

        if (!$_POST['page'])
            $_POST['page'] = 1;
        if (!$_POST['rp'])
            $_POST['rp'] = 10;
        $_start = ($_POST['page'] - 1) * $_POST['rp'];

        $_where = '0 = 0 AND c.`category_id` = s.`root_id`';
        $_bindParam = array();

        if (isset($_POST['sltDateA']) && $_POST['sltDateA'] && $_POST['sltDateB']) {
            $_where .= ' AND (s.`release_date` BETWEEN :sltDateA AND :sltDateB)';
            $_bindParam[':sltDateA'] = $_POST['sltDateA'];
            $_bindParam[':sltDateB'] = $_POST['sltDateB'];
        }
        if (isset($_POST['strSearchKeyword']) && $_POST['strSearchKeyword'] != '') {
            $_where .= ' AND (s.`name` LIKE :strSearchKeyword)';
            $_bindParam[':strSearchKeyword'] = '%' . trim($_POST['strSearchKeyword']) . '%';
        }

        //$this->db->debug();
        $_table = '`#@__@category` c, `#@__@series` s';
        $_total = $this->db->table($_table)->where($_where)->bind($_bindParam)->count();
        $_rs = $this->db->select('s.*, c.`category_name`')
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
                $_idValue = $m->series_id;
                array_push($_rsp['rows'], array(
                    'id' => $_idValue,
                    'cell' => array(
                        $_idValue,
                        '<span' . Auxi::getDeepColor($m->level) . '>' . $m->level . '</span>',
                        $m->root_id,
                        Helper::getTreeIMG(1, $m->category_name, $context['__ASSETS__']),
                        Helper::getTreeIMG($m->level, $m->name, $context['__ASSETS__']),
                        '<span' . Auxi::getDeepColor($m->is_display) . '>' . $this->setting['aryBool'][intval($m->is_display)] . '</span>',
                        $m->sort,
                        Auxi::getTime($m->release_date)
                    )
                ));
            }
        }
        echo(MsgHelper::json('SUCCESS', '数据返回成功', $_rsp));
    }

}
