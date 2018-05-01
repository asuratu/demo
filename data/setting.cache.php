<?php

if (!defined('IN_PX'))
    exit;
return array(
    'aryPicExtName' => array('gif', 'jpg', 'jpeg', 'bmp', 'png'),
    'aryFileExtName' => array('pdf'),
    'aryUploadPath' => array('pics', 'files'),
    'aryBool' => array('否', '是'),
    'arySex' => array('女', '男', '保密'),
    'aryAnchorStatus' => array('不使用', '使用'),
    'aryFooterLinkTarget' => array('_blank', '_self'),
    'aryFooterLinkType' => array('当前页', '全站'),
    'aryNavType' => array('主导航', '副导航', '跟随上级'),
    'aryDisplay' => array('不显示', '显示'),
    'aryGoodsDisplay' => array('下架', '上架'),
    'aryPart' => array('列表栏目(允许在本栏目发布文档)', '单页栏目(生成单页，可使用seo及高级功能)', '外部链接(在"文件保存目录"处填写网址)'),
    'aryPartShow' => array('列表栏目', '单页栏目', '外部链接'),
    'aryScope' => array('add' => '添加', 'edit' => '修改', 'delete' => '删除', 'view' => '查看', 'approved' => '审核', 'export' => '导出', 'batch' => '批量处理'),
    'aryChannelTypeMapping' => array(
        'zh-CN' => array(
            // 内容模型名称，内容模型相对路径，列表显示的分页信息数量，列表页若存在列表用于显示详细信息的路径(不存在可为空),'首页的列表显示数量'
            0 => array('企业简介', 'about/index', 0, '', 8) ,
            1 => array('企业文化', 'about/culture', 0, '', 8) ,
            2 => array('产品展示', 'project/index', 8, 'project/detail', 8) ,
            3 => array('技术支持', 'technology/index', 0, '', 8) ,
            4 => array('下载中心', 'down/index', 6, 'detail', 8) ,
            5 => array('新闻动态', 'news/index', 6, 'news/detail', 8) ,
            6 => array('联系方式', 'contact/index', 0, '', 8) ,
            7 => array('招贤纳士', 'contact/join', 3, '', 8)
        ),
        'en' => array(
            // 内容模型名称，内容模型相对路径，列表显示的分页信息数量，列表页若存在列表用于显示详细信息的路径(不存在可为空),'首页的列表显示数量'
            0 => array('en企业简介', 'about/index', 0, '', 8) ,
            1 => array('en企业文化', 'about/culture', 0, '', 8) ,
            2 => array('en产品展示', 'project/index', 8, 'project/detail', 8) ,
            3 => array('en技术支持', 'technology/index', 0, '', 8) ,
            4 => array('en下载中心', 'down/index', 6, 'detail', 8) ,
            5 => array('en新闻动态', 'news/index', 6, 'news/detail', 8) ,
            6 => array('en联系方式', 'contact/index', 0, '', 8) ,
            7 => array('en招贤纳士', 'contact/join', 3, '', 8)
        )
    ),
    'aryArchivesDeleteCacheBindId' => array(
//		'cacheIndexNotice',
//		'cacheIndexArchivesList',
//		'cacheIndexMedicalEquipment'
    ),
    'aryShopDeleteCacheBindId' => array(
        'cacheHomepageLatestShop',
    ),
    'aryAreaType' => array(
        '直辖市',
        '华北地区',
        '东北地区',
        '华东地区',
        '华中地区',
        '华南地区',
        '西北地区',
        '西南地区',
        '其他地区'
    ),
    'aryMunicipality' => array(
        '0' => '全国',
        '1' => '上海',
        '2' => '北京',
        '3' => '天津',
        '4' => '重庆'
    ),
    'aryArchivesStatus' => array(
        '普通',
        '最新',
        '热门',
        '置顶'
    ),
    'aryGoodsStatus' => array(
        '普通',
        '新品',
        '特价',
        '热卖',
        '人气'
    ),
    'aryAd' => array(
        'PC首页切换图 1920*550',
        '手机首页切换图 640*320',
        '首页底部新闻切换图 396*201',
        '荣誉证书切换图 304*377',
        '首页产品展示 304*377',
    ),
    //操作日志使用
    'aryOption' => array(
        'add' => '添加',
        'edit' => '修改',
        'delete' => '删除',
        'view' => '查看',
        'read' => '查看',
        'approved' => '审核',
        'cancel' => '撤销',
        'export' => '导出',
        'setfieldvalue' => '修改状态',
        'setdisplay' => '修改状态',
        'setfieldstatus' => '修改状态',
        'delfile' => '删除文件',
        'delmultiplefile' => '删除文件',
        'upload' => '上传文件',
        'login' => '登陆',
        'logout' => '退出',
        'editpwd' => '修改密码',
        'downloadexcel' => '导出Excel',
        'filemanager' => '文件管理'
    ),
);
