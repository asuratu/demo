<?php
if(!defined('IN_PX')) exit;
return array (
  '/detail/{id:\\d+}' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\ZhCN\\Index',
        '__PROCESS__' => 'productDetail',
        '__REQUEST_MAPPING__' => 'news/detail',
        '__Route' => true,
      ),
      'POST' => 'GET',
      '__STRLEN__' => 9,
      '__PARAMS__' => NULL,
      '__REGX__' => '\\/detail\\/\\d+',
      '__PRIORITYS__' => 
      array (
        'id' => '\\d+',
      ),
      '__CONSTANTS__' => 
      array (
        0 => 'detail',
      ),
    ),
  ),
);