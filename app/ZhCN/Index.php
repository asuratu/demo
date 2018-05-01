<?php

namespace App\ZhCN;

if (!defined('IN_PX'))
    exit;

use App\Service;
use App\Repository;
use App\Tools\Auxi;
use Phoenix\Log\Log4p as logger;

/**
 * 首页
 */
class Index {

    private function __Controller() {}

    private function __Value($__PACKAGE__, $__ROOT__, $__RM__, $setting, $cfg, $__LANGUAGE_ID__) {}

    protected function __Inject($session, Service\Archives $servArc, Repository\Archives $repoArc,
                                Repository\Category $category) {}

    public function index() {
        if ($this->servArc->chkCategoryDataView()) {
            $_model['aryCategoryDataView'] = $this->servArc->aryCategoryDataView;
            $_model['aryAd'] = $this->repoArc->getAd($this->__LANGUAGE_ID__);
            $_model['aryAdMb'] = $this->repoArc->getAd($this->__LANGUAGE_ID__, 1);

            $_model['contactHash'] = md5(time() . 'zy_contact_hash');
            $this->session->contactHash = array('hash' => $_model['contactHash'], 'time' => 0);

            //产品-编码器
            // $_model['code'] = $this->repoArc->getiIndexArchList(13);
            // //产品-光学产品
            // $_model['light'] = $this->repoArc->getiIndexArchList(14);
            // //产品-锗制品
            // $_model['zhe'] = $this->repoArc->getiIndexArchList(15);

            $_model['code'] = $this->repoArc->getAd($this->__LANGUAGE_ID__, 4);

            //首页底部链接
            $_model['products'] = $this->repoArc->getAd($this->__LANGUAGE_ID__, 2);

            return array (
                'model' => $_model,
                'view' => true
            );
        }
        return 404;
    }

    public function category($__Route = array('/*/{aliasId}/{page:\d*}', '/category/{aliasId}/{page}')) {
        if (!is_null(($_model = $this->servArc->getCategoryRs($this->aliasId, true)))) {
            $_model['aliasId'] = $this->aliasId;
            $_model['aryCategoryDataView'] = $this->servArc->aryCategoryDataView;

            if ($_model['channelType'] == 14) {
                $_model['footerLink'] = $this->repoArc->getFooterLink($this->__LANGUAGE_ID__); //底部链接
            }

            if (!isset($this->page)) {
                $this->page = 1;
            }
            $_model['currentPage'] = $this->page;

            //企业简介
            if ($_model['channelType'] == 0) {
                //荣誉证书
                $_model['paper'] = $this->repoArc->getAd($this->__LANGUAGE_ID__, 3);
            }
            //产品展示
            if ($_model['channelType'] == 2) {
                $idArr = explode('.', $_model['idTree']);
                $_model['navArr'] = $idArr;
                $_model['oneList'] = $this->repoArc->findArrList($idArr[2]);
                $_model['twoList'] = $this->repoArc->findArrList($idArr[3]);
                //产品列表
                $_model['currentCategoryTotal'] = $this->repoArc->findProductCount($_model['categoryId']);
                $_model['currentListRs'] = $this->repoArc->findProductList($_model['categoryId'],
                $_model['currentPageSize'] * ($_model['currentPage'] - 1),
                $_model['currentPageSize']);
                //二级栏目全部产品
                if ($_model['level'] == 2) {
                    //全部
                    $_model['currentCategoryTotal'] = $this->repoArc->findAllProductCount($_model['categoryId']);
                    $_model['currentListRs'] = $this->repoArc->findAllProductList($_model['categoryId'],
                        $_model['currentPageSize'] * ($_model['currentPage'] - 1),
                        $_model['currentPageSize']);
                    $_model['rootName'] = $_model['categoryName'];
                    $_model['rootListDir'] = $_model['listDir'];
                } else {
                    $_model['rootName'] = $this->repoArc->getRootName($_model['idTree'])->category_name;
                    $_model['rootListDir'] = $this->repoArc->getRootName($_model['idTree'])->list_dir;
                }

            }
            //新闻动态
            if ($_model['channelType'] == 5) {
                //产品列表
                $_model['currentCategoryTotal'] = $this->repoArc->findProductCount($_model['categoryId']);
                $_model['currentListRs'] = $this->repoArc->findProductList($_model['categoryId'],
                $_model['currentPageSize'] * ($_model['currentPage'] - 1),
                $_model['currentPageSize']);
            }
            //下载中心
            if ($_model['channelType'] == 4) {
                $idArr = explode('.', $_model['idTree']);
                $_model['navArr'] = $idArr;
                $_model['oneList'] = $this->repoArc->findArrList($idArr[2]);
                $_model['twoList'] = $this->repoArc->findArrList($idArr[3]);
                $_model['threeList'] = $this->repoArc->findArrList($idArr[4]);
                //文件列表
                $_model['currentCategoryTotal'] = $this->repoArc->findfilesCount($_model['categoryId']);
                $_model['currentListRs'] = $this->repoArc->findfilesList($_model['categoryId'],
                $_model['currentPageSize'] * ($_model['currentPage'] - 1),
                $_model['currentPageSize']);

            }
            //招贤纳士
            if ($_model['channelType'] == 7) {
                //招聘列表
                $_model['currentCategoryTotal'] = $this->repoArc->findRecruitCount($this->__LANGUAGE_ID__);

                $_model['currentListRs'] = $this->repoArc->findRecruitList($this->__LANGUAGE_ID__,
                $_model['currentPageSize'] * ($_model['currentPage'] - 1),
                $_model['currentPageSize']);

            }


            $_model['contactHash'] = md5(time() . 'zy_contact_hash');
            $this->session->contactHash = array('hash' => $_model['contactHash'], 'time' => 0);

            return array(
                'model' => $_model,
                'view' => $this->setting['aryChannelTypeMapping'][$this->__PACKAGE__][$_model['channelType']][1]
            );
        }
        return 404;
    }


    public function search($__Route = array('/search/{page:\d*}')) {

            if ($this->__LANGUAGE_ID__ == 0) {
                //中文
                $this->aliasId = 'encoder';
            } else {
                //英文
                $this->aliasId = 'enencoder';
            }

        if (!is_null(($_model = $this->servArc->getCategoryRs($this->aliasId, true)))) {


            $_model['aliasId'] = $this->aliasId;
            $_model['aryCategoryDataView'] = $this->servArc->aryCategoryDataView;
            $keywords = $_GET['key'];

            if (!isset($this->page)) {
                $this->page = 1;
            }
            $_model['currentPage'] = $this->page;

            //产品展示
            if ($_model['channelType'] == 2) {
                //产品列表
//                $_model['currentPageSize'] = 1;
                $_model['currentCategoryTotal'] = $this->repoArc->findSearchProductCount($this->__LANGUAGE_ID__, $keywords);
                $_model['currentListRs'] = $this->repoArc->findSearchProductList($this->__LANGUAGE_ID__, $keywords,
                $_model['currentPageSize'] * ($_model['currentPage'] - 1),
                $_model['currentPageSize']);
            }


            $_model['contactHash'] = md5(time() . 'zy_contact_hash');
            $this->session->contactHash = array('hash' => $_model['contactHash'], 'time' => 0);

            if ($this->__LANGUAGE_ID__ == 0) {
                //中文
                $_model['aliasId'] = 'search';
            } else {
                //英文
                $_model['aliasId'] = 'en/search';
            }
            //视图


            return array(
                'model' => $_model,
                'view' => 'project/search'
            );
        }
        return 404;
    }





    public function productDetail($__Route = array('/project/detail/{id:\d+}', '/news/detail/{id:\d+}')) {
        if (!is_null(($_model = $this->servArc->getSubstance($this->id)))) {
            $_model['aryCategoryDataView'] = $this->servArc->aryCategoryDataView;
            $idArr = explode('.', $_model['idTree']);
            $_model['navArr'] = $idArr;
            $_model['src'] = $this->repoArc->findArchivesSrc($this->id);
            $_model['files'] = $this->repoArc->findArchivesfiles($_model['file_id']);
            $_model['products'] = $this->repoArc->findArchivesProducts($_model['archives_id_str']);
            $_model['contactHash'] = md5(time() . 'zy_contact_hash');
            $this->session->contactHash = array('hash' => $_model['contactHash'], 'time' => 0);
            return array(
                'model' => $_model,
                'view' => $this->setting['aryChannelTypeMapping'][$this->__PACKAGE__][$_model['channelType']][3]
            );
        }
        return 404;
    }

}
