<?php

if (!defined('IN_PX'))
    exit;

return array(
    'structure' => array(
        'title' => '文档',
        'menu' => array(
            'archives' => array(
                'name' => '产品管理', 'scope' => array('view', 'add', 'edit', 'delete'),
                'class' => 'ico_list'
            ),
            'news' => array(
                'name' => '新闻管理', 'scope' => array('view', 'add', 'edit', 'delete'),
                'class' => 'ico_list'
            ),

            'recruit' => array(
                'name' => '招聘管理', 'scope' => array('view', 'add', 'edit', 'delete'),
                'class' => 'ico_type'
            ),
//            'series' => array(
//                'name' => '多级栏目管理', 'scope' => array('view', 'add', 'edit', 'delete'),
//                'class' => 'ico_type'
//            ),

            'file' => array(
                'name' => '文件下载管理', 'scope' => array('view', 'add', 'edit', 'delete'),
                'class' => 'ico_type'
            ),
            'footerLink' => array(
                'name' => '友情链接管理', 'scope' => array('view', 'add', 'edit', 'delete'),
                'class' => 'ico_link'
            ),
            'ad' => array(
                'name' => '图片广告管理', 'scope' => array('view', 'add', 'edit', 'delete'),
                'class' => 'ico_ad'
            ),
            'category' => array(
                'name' => '栏目管理', 'scope' => array('view', 'add', 'edit', 'delete'),
                'class' => 'ico_type'
            ),
            'more' => array(
                'name' => '系列栏目管理', 'scope' => array('view', 'add', 'edit', 'delete'),
                'class' => 'ico_type'
            ),
            'create' => array(
                'name' => '生成管理', 'scope' => array('edit')
            , 'class' => 'ico_create'
            )
        )
    ),
    'setting' => array(
        'title' => '系统',
        'menu' => array(
            'user' => array(
                'name' => '管理员列表', 'scope' => array('view', 'add', 'edit', 'delete'),
                'class' => 'ico_user'
            ),
            'role' => array(
                'name' => '管理角色列表', 'scope' => array('view', 'add', 'edit', 'delete'),
                'class' => 'ico_role'
            ),
            'content' => array(
                'name' => '配置列表', 'scope' => array('edit'), 'class' => 'ico_gear'
            ),
            'action' => array(
                'name' => '操作日志', 'scope' => array('view', 'export'), 'class' => 'ico_gear'
            )
        )
    ),
    'contactForm' => array(
        'title' => '联系表单',
        'menu' => array(
            'contact' => array(
                'name' => '联系表单列表', 'scope' => array('view', 'delete'),
                'class' => 'ico_user'
            )
        )
    )
);
