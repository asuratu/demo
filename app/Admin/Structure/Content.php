<?php

namespace App\Admin\Structure;

if (!defined('IN_PX'))
    exit;

use App\Admin\AbstractCommon;
use App\Model;

/**
 * 内容页
 */
class Content extends AbstractCommon {

    private function __Controller() {}

    //private function __Route($value = '/structure') {}
    protected function __Inject($db) {}

    public function archivesContent() {
        if ($this->_boolCanReadData()) {
            $this->rs = $this->db->select('a.*, ars.*')
                ->table('`#@__@archives` a, `#@__@archives_substance` ars')
                ->where('a.`archives_id` = ? AND a.`archives_id` = ars.`archives_id`')
                ->bind(array($_GET['id']))
                ->find();
            $linkStr = str_replace("|",",",$this->rs->file_id);
            //关联文档
            $this->db->debug();
            $this->link_archives = $this->db->select('f.*')
                ->table('`#@__@file` f')
                ->where('f.`file_id` IN('.$linkStr.')')
                ->findAll();



            $linStr = str_replace("|",",",$this->rs->archives_id_str);
            $this->lin_archives = $this->db->select('a.*')
                ->table('`#@__@archives` a')
                ->where('a.`archives_id` IN('.$linStr.')')
                ->findAll();

        } else {
            $this->link_archives = array();
            $this->lin_archives = array();
        }
        if (!isset($_GET['parentId'])){
            $_GET['parentId'] = '';
        }
        if (!isset($_GET['id'])) {
            $_GET['id'] = '';
        }
        $this->sltIDTree = $this->_selectIDTree(array('table' => '`#@__@category`',
            'where' => '`is_display` = 1 AND (`root_id` = 12 OR `root_id` = 84)'),
            array('value' => 'category_id', 'text' => 'category_name',
                'selected' => $this->rs ? $this->rs->category_id : $_GET['parentId']),
            array('disabled' => $this->pageControl));
        $this->getSort = $this->_getSort('archives');

        $this->banners= $this->db->select('`src`')
            ->table('`#@__@archives_attach`')
            ->where('`archives_id` = ?')
            ->bind(array($_GET['id']))
            ->findAll();
        $this->banners = json_encode($this->banners);




        return true;
    }

    public function newsContent() {
        if ($this->_boolCanReadData()) {
            $this->rs = $this->db->select('a.*, ars.*')
                ->table('`#@__@archives` a, `#@__@archives_substance` ars')
                ->where('a.`archives_id` = ? AND a.`archives_id` = ars.`archives_id`')
                ->bind(array($_GET['id']))
                ->find();
        }
        if (!isset($_GET['parentId'])){
            $_GET['parentId'] = '';
        }
        if (!isset($_GET['id'])) {
            $_GET['id'] = '';
        }
        $this->sltIDTree = $this->_selectIDTree(array('table' => '`#@__@category`',
            'where' => '`is_display` = 1 AND (`root_id` = 23 OR `root_id` = 95)'),
            array('value' => 'category_id', 'text' => 'category_name',
                'selected' => $this->rs ? $this->rs->category_id : $_GET['parentId']),
            array('disabled' => $this->pageControl));
        $this->getSort = $this->_getSort('archives');

        $this->banners= $this->db->select('`src`')
            ->table('`#@__@archives_attach`')
            ->where('`archives_id` = ?')
            ->bind(array($_GET['id']))
            ->findAll();
        $this->banners = json_encode($this->banners);

        return true;
    }

    public function categoryContent() {
        if ($this->_boolCanReadData()) {
            $this->rs = $this->db->select('c.*, cs.*')
                ->table('`#@__@category` c, `#@__@category_substance` cs')
                ->where('c.`category_id` = ? AND c.`category_id` = cs.`category_id`')
                ->bind(array($_GET['id']))
                ->find();
        }
        if (!isset($_GET['parentId'])) {
            $_GET['parentId'] = '';
        }
        if (!isset($_GET['parentChannelType'])) {
            $_GET['parentChannelType'] = 0;
        }
        if (!isset($_GET['parentIsPart'])) {
            $_GET['parentIsPart'] = 0;
        }
        if (!isset($_GET['parentNavType'])) {
            $_GET['parentNavType'] = 0;
        }
        if (!isset($_GET['id'])) {
            $_GET['id'] = '';
        }
        $this->sltIDTree = $this->_selectIDTree(array('table' => '`#@__@category`',
            'where' => '`is_display` = 1 AND `level` < 3'),
            array('value' => 'category_id', 'text' => 'category_name',
                'selected' => $this->rs ? $this->rs->parent_id : $_GET['parentId']),
            array('disabled' => $this->pageControl));
        $this->getSort = $this->_getSort();
        $this->getHomeSort = $this->_getSort('category', 'home_sort');

        return true;
    }


    public function moreContent() {
        if ($this->_boolCanReadData()) {
            $this->rs = $this->db->select('c.*, cs.*')
                ->table('`#@__@category` c, `#@__@category_substance` cs')
                ->where('c.`category_id` = ? AND c.`category_id` = cs.`category_id`')
                ->bind(array($_GET['id']))
                ->find();
        }
        if (!isset($_GET['parentId'])) {
            $_GET['parentId'] = '';
        }
        if (!isset($_GET['parentChannelType'])) {
            $_GET['parentChannelType'] = 0;
        }
        if (!isset($_GET['parentIsPart'])) {
            $_GET['parentIsPart'] = 0;
        }
        if (!isset($_GET['parentNavType'])) {
            $_GET['parentNavType'] = 0;
        }
        if (!isset($_GET['id'])) {
            $_GET['id'] = '';
        }
        $this->sltIDTree = $this->_selectIDTree(array('table' => '`#@__@category`',
            'where' => '`is_display` = 1 AND `root_id` IN(12, 20, 84, 92)'),
            array('value' => 'category_id', 'text' => 'category_name',
                'selected' => $this->rs ? $this->rs->parent_id : $_GET['parentId']),
            array('disabled' => $this->pageControl));
        $this->getSort = $this->_getSort();
        $this->getHomeSort = $this->_getSort('category', 'home_sort');

        return true;
    }


    public function seriesContent() {
        if ($this->_boolCanReadData()) {
            $this->rs = $this->db->select('s.*, c.`category_name`')
                ->table('`#@__@category` c, `#@__@series` s')
                ->where('s.`series_id` = ? AND c.`category_id` = s.`root_id`')
                ->bind(array($_GET['id']))
                ->find();
        }
        if (!isset($_GET['parentId'])) {
            $_GET['parentId'] = '';
        }

        if (!isset($_GET['id'])) {
            $_GET['id'] = '';
        }
        $this->sltIDTree = $this->_selectSeriesIDTree(array('table' => '`#@__@category`',
            'where' => '`is_display` = 1'),
            array('value' => 'category_id', 'text' => 'category_name',
                'selected' => $this->rs ? $this->rs->root_id : $_GET['parentId']),
            array('disabled' => $this->pageControl));
        $this->sltSeriesIDTree = $this->_selectIDTree(array('table' => '`#@__@series`',
            'where' => '`is_display` = 1'),
            array('value' => 'series_id', 'text' => 'name',
                'selected' => $this->rs ? $this->rs->parent_id : $_GET['parentId']),
            array('disabled' => $this->pageControl));
        $this->getSort = $this->_getSeriesSort();

        return true;
    }

    public function adContent() {
        if ($this->_boolCanReadData()) {
            $this->rs = $this->db->select()
                ->table('`#@__@ad`')
                ->where('`ad_id` = ?')
                ->bind(array($_GET['id']))
                ->find();
        }
        if (!isset($_GET['parentId'])) {
            $_GET['parentId'] = '';
        }
        if (!isset($_GET['id'])) {
            $_GET['id'] = '';
        }
        $this->getSort = $this->_getSort('ad', 'ad_sort');
        return true;
    }

    public function recruitContent() {
        if ($this->_boolCanReadData()) {
            $this->rs = $this->db->select()
                ->table('`#@__@recruit`')
                ->where('`recruit_id` = ?')
                ->bind(array($_GET['id']))
                ->find();
        }
        if (!isset($_GET['parentId'])) {
            $_GET['parentId'] = '';
        }
        if (!isset($_GET['id'])) {
            $_GET['id'] = '';
        }
        $this->getSort = $this->_getSort('recruit', 'sort');
        return true;
    }

    public function fileContent() {
        if ($this->_boolCanReadData()) {
            $this->rs = $this->db->select()
                ->table('`#@__@file`')
                ->where('`file_id` = ?')
                ->bind(array($_GET['id']))
                ->find();
        }
        if (!isset($_GET['parentId'])) {
            $_GET['parentId'] = '';
        }
        if (!isset($_GET['id'])) {
            $_GET['id'] = '';
        }
        $this->sltIDTree = $this->_selectIDTree(array('table' => '`#@__@category`',
            'where' => '`is_display` = 1 AND (`root_id` = 20 OR `root_id` = 92)'),
            array('value' => 'category_id', 'text' => 'category_name',
                'selected' => $this->rs ? $this->rs->category_id : $_GET['parentId']),
            array('disabled' => $this->pageControl));
        $this->getSort = $this->_getSort('file', 'sort');


        return true;
    }

    public function anchorTextContent() {
        if ($this->_boolCanReadData()) {
            $this->rs = $this->db->select()
                ->table('`#@__@anchor_text`')
                ->where('`anchor_text_id` = ?')
                ->bind(array($_GET['id']))
                ->find();
        }
        if (!isset($_GET['id'])) {
            $_GET['id'] = '';
        }
        return true;
    }

    public function footerLinkContent() {
        if ($this->_boolCanReadData()) {
            $this->rs = $this->db->select()
                ->table('`#@__@footer_link`')
                ->where('`footer_link_id` = ?')
                ->bind(array($_GET['id']))
                ->find();
        }
        if (!isset($_GET['parentId'])) {
            $_GET['parentId'] = '';
        }
        if (!isset($_GET['id'])) {
            $_GET['id'] = '';
        }
        $this->sltIDTree = $this->_selectIDTree(array('table' => '`#@__@category`',
            'where' => '`is_display` = 1'),
            array('value' => 'category_id', 'text' => 'category_name',
                'selected' => $this->rs ? $this->rs->category_id : $_GET['parentId']),
            array('disabled' => $this->pageControl),
            array('首页链接' => '0', '英文首页链接' => '1', '法文首页链接' => '2'));

        return true;
    }

}
