<?php

namespace App\Handler\Admin\Structure\Series;

if (!defined('IN_PX'))
    exit;

use App\Handler\Admin\AbstractCommon;
use App\Service\Archives;
use App\Service\Templates;
use App\Service\UPFile;
use App\Tools\Html;
use Phoenix\Support\MsgHelper;
use Exception;

/**
 * 修改
 */
class Edit extends AbstractCommon {

    protected function __Inject($db, $cache, $session, UPFile $upFile,
                                Archives $serviceArchives = null, Templates $toolsTemplates = null) {}

    public function processRequest(Array & $context) {
        try {
            $this->db->beginTransaction();

            $this->_getSeriesIdTree();
            $_POST['release_date'] = strtotime($_POST['release_date']);
            $_POST['root_id'] = $_POST['category_id'];
            $_POST['series_id'] = $_POST['id'];
            $_POST['id_tree'] = $_POST['id_tree'] . str_pad($_POST['id'], 3, '0', STR_PAD_LEFT) . '.';
            $idArr = explode('.', $_POST['id_tree']);
            $_POST['level'] = count($idArr);
            $_return = $this->db->table('`#@__@series`')
                ->row(array(
                    '`root_id`' => '?',
                    '`parent_id`' => '?',
                    '`name`' => '?',
                    '`sort`' => '?',
                    '`level`' => '?',
                    '`id_tree`' => '?',
                    '`release_date`' => '?',
                    '`is_display`' => '?',
                    '`language`' => '?'
                ))
                ->where('`series_id` = ?')
                ->bind($_POST)
                ->update();


            $this->db->commit();
            echo(MsgHelper::json($_return ? 'SUCCESS' : ($_return == 0 ? 'NO_CHANGES' : 'DB_ERROR')));
        } catch (Exception $e) {

            $this->db->rollBack();
            echo(MsgHelper::json('DB_ERROR'));
        }
    }

}
