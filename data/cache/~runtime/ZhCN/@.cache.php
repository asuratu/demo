<?php
if(!defined('IN_PX')) exit;
return array (
  '/{aliasId}/{page:\\d*}' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\ZhCN\\Index',
        '__PROCESS__' => 'category',
        '__REQUEST_MAPPING__' => '*',
        '__Route' => true,
      ),
      'POST' => 'GET',
      '__STRLEN__' => 4,
      '__REGX__' => '\\/?[^\\/]*\\/?\\d*',
      '__PARAMS__' => 
      array (
        0 => 'aliasId',
      ),
      '__PRIORITYS__' => 
      array (
        'page' => '\\d*',
      ),
    ),
  ),
);