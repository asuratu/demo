<?php
if(!defined('IN_PX')) exit;
return array (
  '/{aliasId}/{page}' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\ZhCN\\Index',
        '__PROCESS__' => 'category',
        '__REQUEST_MAPPING__' => 'category',
        '__Route' => true,
      ),
      'POST' => 'GET',
      '__STRLEN__' => 4,
      '__PARAMS__' => 
      array (
        0 => 'aliasId',
        1 => 'page',
      ),
      '__REGX__' => '\\/?[^\\/]*\\/?[^\\/]*',
    ),
  ),
);