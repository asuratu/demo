<?php

namespace App\Repository\Impl;

if (!defined('IN_PX'))
    exit;

use App\Repository\Archives;
use PDO;

class ArchivesImpl implements Archives {

    //仓储层组件
    private function __Repository($value = 'archives') {}

    private function __Inject($db) {}

//    public function count($categoryId, $__Inject = array('$db')) {
    public function count($categoryId) {
        return intval($this->db->table('`#@__@archives`')
            ->where('`category_id` = ? AND `is_display` = 1')
            ->bind(array($categoryId))
            ->count());
    }

    public function find($id) {
        $_field = is_numeric($id) ? 'archives_id' : 'seo_url';
        $this->db->debug();
        return $this->db->select('a.*, ars.*, c.`level`, c.`id_tree`, c.`parent_id`,'
            . 'c.`root_id`, c.`is_part`, c.`channel_type`, c.`nav_type`')
            ->table('`#@__@archives` a, `#@__@archives_substance` ars, `#@__@category` c')
            ->where("a.`{$_field}` = ? AND a.`is_display` = 1 AND a.`archives_id` = ars.`archives_id`"
                . ' AND a.`category_id` = c.`category_id` AND c.`is_display` = 1')
            ->bind(array($id))
            ->find();
    }

    public function getOtherNav($rootId) {
        return $this->db->select('s.*')
            ->table('`#@__@series` s')
            ->where("s.`is_display` = 1 AND s.`root_id` = ?")
            ->bind(array($rootId))
            ->order('s.`id_tree`', 'ASC')
            ->findAll();
    }

    public function findArrList($parentId) {
        return $this->db->select('c.*')
            ->table('`#@__@category` c')
            ->where("c.`is_display` = 1 AND c.`parent_id` = ?")
            ->bind(array($parentId))
            ->order('c.`id_tree`', 'ASC')
            ->findAll();
    }


    public function findfilesCount($categoryId) {
        return $this->db->select('f.*')
            ->table('`#@__@file` f')
            ->where("f.`is_display` = 1 AND f.`category_id` = ?")
            ->bind(array($categoryId))
            ->count();
    }

    public function findRecruitCount($language) {
        return $this->db->select('r.*')
            ->table('`#@__@recruit` r')
            ->where("r.`is_display` = 1 AND r.`language` = ?")
            ->bind(array($language))
            ->count();
    }

    public function findProductCount($categoryId) {
        return $this->db->select('a.*')
            ->table('`#@__@archives` a')
            ->where("a.`is_display` = 1 AND a.`category_id` = ?")
            ->bind(array($categoryId))
            ->count();
    }

    public function findAllProductCount($categoryId) {
        //当前二级栏目的所有四级栏目
         if (strlen($categoryId) == 1) {
            $categoryStr = '00'.$categoryId;
        } elseif (strlen($categoryId) == 2) {
            $categoryStr = '0'.$categoryId;
        } else {
            $categoryStr = $categoryId;
        }
        $result = $this->db->select('c.`category_id`')
            ->table('`#@__@category` c')
            ->where("c.`is_display` = 1 AND c.`id_tree` like '%".$categoryStr."%' AND c.`level` = 4")
            ->findAll();
        $arr = array();
        foreach ($result as $value) {
            array_push($arr, $value->category_id);
        }
        $str = implode(',', $arr);

        return $this->db->select('a.*')
            ->table('`#@__@archives` a')
            ->where("a.`is_display` = 1 AND a.`category_id` IN($str)")
            ->count();
    }

    public function findAllFileCount($categoryId) {
        //当前栏目的所有四级栏目
          if (strlen($categoryId) == 1) {
            $categoryStr = '00'.$categoryId;
        } elseif (strlen($categoryId) == 2) {
            $categoryStr = '0'.$categoryId;
        } else {
            $categoryStr = $categoryId;
        }
        $result = $this->db->select('c.`category_id`')
            ->table('`#@__@category` c')
            ->where("c.`is_display` = 1 AND c.`id_tree` like '%".$categoryStr."%' AND c.`level` = 5")
            ->findAll();
        $arr = array();
        foreach ($result as $value) {
            array_push($arr, $value->category_id);
        }
        $str = implode(',', $arr);

        return $this->db->select('f.*')
            ->table('`#@__@file` f')
            ->where("f.`is_display` = 1 AND f.`category_id` IN($str)")
            ->count();
    }

    public function findfilesList($categoryId, $start = null, $end = null) {
        return $this->db->select('f.*')
            ->table('`#@__@file` f')
            ->where('f.`is_display` = 1 AND f.`category_id` = ?')
            ->order('f.`sort` DESC, f.`release_date`')
            ->limit($start, $end)
            ->bind(array($categoryId))
            ->findAll();
    }

    public function findRecruitList($language, $start = null, $end = null) {
        return $this->db->select('r.*')
            ->table('`#@__@recruit` r')
            ->where('r.`is_display` = 1 AND r.`language` = ?')
            ->bind(array($language))
            ->order('r.`sort` DESC, r.`release_date`')
            ->limit($start, $end)
            ->findAll();
    }

    public function findProductList($categoryId, $start = null, $end = null) {
        return $this->db->select('a.*')
            ->table('`#@__@archives` a')
            ->where('a.`is_display` = 1 AND a.`category_id` = ?')
            ->order('a.`sort` DESC, a.`release_date`')
            ->limit($start, $end)
            ->bind(array($categoryId))
            ->findAll();
    }




    //所有产品中带有关键字的
    public function findSearchProductCount($language, $keywords) {
        return $this->db->select('a.*')
            ->table('`#@__@archives` a, `#@__@category` c')
            ->where("a.`is_display` = 1 AND a.`category_id` = c.`category_id` AND c.`root_id` IN(12, 84) AND a.`language` = ? AND a.`title` LIKE '%".$keywords."%'")
            ->bind(array($language))
            ->count();
    }

    public function findSearchProductList($language, $keywords, $start = null, $end = null) {
        return $this->db->select('a.*')
            ->table('`#@__@archives` a, `#@__@category` c')
            ->where("a.`is_display` = 1 AND a.`category_id` = c.`category_id` AND c.`root_id` IN(12, 84) AND a.`language` = ? AND a.`title` LIKE '%".$keywords."%'")
            ->order('a.`sort` DESC, a.`release_date`')
            ->limit($start, $end)
            ->bind(array($language))
            ->findAll();
    }

    public function getRootName($idTree) {
        $arr = explode('.', $idTree);
        return $this->db->select('c.*')
            ->table('`#@__@category` c')
            ->where('c.`is_display` = 1 AND c.`category_id` = ?')
            ->bind(array(intval($arr[2])))
            ->find();
    }

    public function findAllProductList($categoryId, $start = null, $end = null) {
        //当前二级栏目的所有四级栏目
        if (strlen($categoryId) == 1) {
            $categoryStr = '00'.$categoryId;
        } elseif (strlen($categoryId) == 2) {
            $categoryStr = '0'.$categoryId;
        } else {
            $categoryStr = $categoryId;
        }
        $result = $this->db->select('c.`category_id`')
            ->table('`#@__@category` c')
            ->where("c.`is_display` = 1 AND c.`id_tree` like '%".$categoryStr."%' AND c.`level` = 4")
            ->findAll();
        $arr = array();
        foreach ($result as $value) {
            array_push($arr, $value->category_id);
        }
        $str = implode(',', $arr);
        $this->db->debug();
        return $this->db->select('a.*')
            ->table('`#@__@archives` a')
            ->where('a.`is_display` = 1 AND a.`category_id` IN('.$str.')')
            ->order('a.`sort` DESC, a.`release_date`')
            ->limit($start, $end)
            ->findAll();
    }

    public function findAllFileList($categoryId, $start = null, $end = null) {
        //当前二级栏目的所有四级栏目
        if (strlen($categoryId) == 1) {
            $categoryStr = '00'.$categoryId;
        } elseif (strlen($categoryId) == 2) {
            $categoryStr = '0'.$categoryId;
        } else {
            $categoryStr = $categoryId;
        }
        $this->db->debug();
        $result = $this->db->select('c.`category_id`')
            ->table('`#@__@category` c')
            ->where("c.`is_display` = 1 AND c.`id_tree` like '%".$categoryStr."%' AND c.`level` = 5")
            ->findAll();

        $arr = array();
        foreach ($result as $value) {
            array_push($arr, $value->category_id);
        }
        $str = implode(',', $arr);
        $this->db->debug();
        return $this->db->select('a.*')
            ->table('`#@__@file` a')
            ->where('a.`is_display` = 1 AND a.`category_id` IN('.$str.')')
            ->order('a.`sort` DESC, a.`release_date`')
            ->limit($start, $end)
            ->bind(array($categoryId))
            ->findAll();
    }


    //点击次数加1
    public function viewCount($id) {
        $this->db->nonCacheable()->table('`#@__@archives`')->row(array(
            'view_count' => 'view_count + 1'
        ))->where('archives_id = ?')->bind(array(
            $id
        ))->update();
    }

    public function findAll($categoryId, $start = null, $end = null) {
        return $this->db->select('a.`archives_id`, a.`title`, a.`cover`, a.`title_english`, a.`seo_url`, a.`synopsis`'
            . ', a.`cover`, a.`is_status`, a.`release_date`, a.`add_date`, a.`language`, a.`attachment`, asb.`substance`, 
            c.`channel_type`, c2.`list_dir`, a.`video_url`')
            ->table('`#@__@archives` a, `#@__@archives_substance` asb, `#@__@category` c, `#@__@category` c2')
            ->where('a.`category_id` = ? AND a.`is_display` = 1 AND a.`category_id` = c.`category_id`'
                . ' AND c.`root_id` = c2.`category_id` AND asb.`archives_id` = a.`archives_id`')
            ->order('a.`sort` DESC, a.`is_status` DESC, a.`release_date`')
            ->limit($start, $end)
            ->bind(array($categoryId))
            ->findAll();
    }


    private function _prevNext($date, $categoryId, $prevOrNext) {
        if ($prevOrNext == '>') {
            $release_date = 'a.`sort`';
            $sort = 'ASC';
        } else {
            $release_date = 'a.`sort`';
            $sort = 'DESC';
        }
        return $this->db->select('a.`archives_id`, a.`title`, a.`seo_url`, a.`language`, c.`channel_type`, c2.`list_dir`')
            ->table('`#@__@archives` a, `#@__@category` c, `#@__@category` c2')
            ->where("a.`sort` {$prevOrNext} ? AND a.`category_id` = ? AND a.`is_display` = 1"
                . ' AND a.`category_id` = c.`category_id` AND c.`root_id` = c2.`category_id`')
            ->bind(array($date, $categoryId))
            ->order($release_date, $sort)
            ->find();
    }

    public function prev($sort, $categoryId) {
        return $this->_prevNext($sort, $categoryId, '>');
    }

    public function next($sort, $categoryId) {
        return $this->_prevNext($sort, $categoryId, '<');
    }

    /**
     * 可用于循环中[chains()]
     * @return mixed
     */
    public function getAnchorText() {
        return $this->db->chains()->select('`text`, `link_url`')
            ->table('`#@__@anchor_text`')
            ->where('`is_status` = 1')
            ->order('LENGTH(`text`) ASC, `anchor_text_sort`', 'ASC')
            ->findAll();
    }

    public function getFooterLink($categoryId = 0, $isHome = false) {
        if ($isHome) { //首页显示
            $_where = '(`category_id` = ? OR `link_type` = 1) AND `is_status` = 1';
        } else {
            $_where = '`language` = ? AND `is_status` = 1';
        }
//        $this->db->debug();
        return $this->db->select()
            ->table('`#@__@footer_link`')
            ->where($_where)
            ->bind(array($categoryId))
            ->order('footer_link_id', 'ASC')
            ->findAll();
    }

    public function getTagsList($id) {
        return $this->db->mode(PDO::FETCH_COLUMN)->select('t.`tags_text`')
            ->table('`#@__@tags_list` tl, `#@__@tags` t')
            ->where('tl.`archives_id` = ? AND tl.`tags_id` = t.`tags_id`')
            ->bind(array($id))
            ->order('t.tags_id', 'ASC')
            ->findAll();
    }

    public function getTags() {
        return $this->db->select()
            ->table('`#@__@tags`')
            ->order('tags_id', 'ASC')
            ->findAll();
    }

    //首页banner图显示
    public function getAd($language, $typeId = 0) {
        return $this->db->select('*')
            ->table('`#@__@ad`')
            ->where('`language` = ? AND `type_id` = ? AND `is_display` = 1')
            ->bind(array($language, $typeId))
            ->order('`ad_sort`', 'ASC')
            ->findAll();
    }


    public function getiIndexArchList($secondId) {
        //找到所有子栏目
        $this->db->debug();
        $result = $this->db->select('*')
            ->table('`#@__@category`')
            ->where('`level` = 4 AND `is_display` = 1 AND `id_tree` LIKE  "%'. $secondId . '%"')
            ->findAll();
        $str = '';
        foreach ($result as $val) {
            $str .= ', ' . $val->category_id;
        }
        $str = ltrim($str, ", ");

        $this->db->debug();
        return $this->db->select('*')
            ->table('`#@__@archives`')
            ->where('`category_id` IN('.$str.') AND `is_display` = 1')
            ->order('`sort`')
            ->limit(0, 9)
            ->findAll();
    }


     public function findiIndexArchList() {
        $this->db->debug();
        return $this->db->select('a.*, c.`category_name`')
            ->table('`#@__@archives` a, `#@__@category` c')
            ->where('a.`category_id` = c.`category_id` AND a.`is_home_display` = 1')
            ->order('a.`sort`')
            ->findAll();
    }

    public function findLogo(){
        return $this->db->select('`synopsis`')
            ->table('`#@__@sys_setting`')
            ->where('`setting_id` = 12')
            ->find();
    }

    public function findHomeArchives($categoryId, $start = null, $end = null, $isHome = false) {
        $_where = ' a.`category_id` = c.`category_id` AND a.`is_display` = 1 AND c.`root_id` = ?';
        $_order = ' a.`sort` DESC, a.`is_status` DESC, a.`release_date` ';
        if ($isHome) {
            $_where =  ' a.`category_id` = c.`category_id` AND a.`is_display` = 1 AND c.`category_id` = ? AND a.`is_status` = 3';
//            $_order = 'a.`sort` DESC, a.`is_status`, a.`release_date`' ;
        }
        return $this->db->select('a.`archives_id`, a.`title_english`, a.`title`, a.`title`, a.`seo_url`, a.`synopsis`'
            . ', a.`cover`, a.`is_status`, a.`release_date` , a.`add_date`, a.`video_url`, a.`language`, c.`channel_type`')
            ->table('`#@__@archives` a, `#@__@category` c')
            ->where($_where)
            ->order($_order)
            ->limit($start, $end)
            ->bind(array($categoryId))
            ->findAll();
    }

    public function findHomeArchivesCount($categoryId) {
        return $this->db->select('a.`archives_id`,a.`title_english`, a.`title`, a.`seo_url`, a.`synopsis`'
            . ', a.`cover`, a.`is_status`, a.`release_date`, a.`language`, c.`channel_type`')
            ->table('`#@__@archives` a, `#@__@category` c')
            ->where(' a.`category_id` = c.`category_id` AND a.`is_display` = 1 AND c.root_id = ?')
            ->order('a.`is_status` DESC, a.`release_date`')
            ->bind(array($categoryId))
            ->count();
    }

    //详情页的多图显示
    public function findArchivesSrc($id) {
        return $this->db->select('*')
            ->table('`#@__@archives_attach`')
            ->where('`archives_id` = ?')
            ->bind(array($id))
            ->findAll();
    }

    public function findArchivesfiles($idStr) {
        $str = str_replace('|', ',', $idStr);
        $this->db->debug();
        return $this->db->select('*')
            ->table('`#@__@file`')
            ->where('`file_id` IN('.$str.') AND `is_display` = 1')
            ->order('`sort`')
            ->findAll();
    }

    public function findArchivesProducts($idStr) {
        $str = str_replace('|', ',', $idStr);
        $this->db->debug();
        return $this->db->select('*')
            ->table('`#@__@archives`')
            ->where('`archives_id` IN('.$str.') AND `is_display` = 1')
            ->order('`sort`')
            ->findAll();
    }

    //首页推荐(一级导航的全部推荐)
    public function getRecommendation($categoryId) {
        $this->db->debug();
        return $this->db->select('a.`archives_id`, a.`title`, a.`cover`, a.`title_english`, a.`seo_url`, a.`synopsis`'
            . ', a.`cover`, a.`is_status`, a.`release_date`, a.`add_date`, a.`language`, a.`attachment`, asb.`substance`, 
            c.`channel_type`, c2.`list_dir`, a.`location`, a.`experience`')
            ->table('`#@__@archives` a, `#@__@archives_substance` asb, `#@__@category` c, `#@__@category` c2')
            ->where('c.`parent_id` = ? AND a.`is_display` = 1 AND a.`is_home_display` = 1 AND a.`category_id` = c.`category_id`'
                . ' AND c.`root_id` = c2.`category_id` AND asb.`archives_id` = a.`archives_id`')
            ->order('a.`is_status` DESC, a.`sort`')
            ->bind(array($categoryId))
            ->findAll();
    }

}
