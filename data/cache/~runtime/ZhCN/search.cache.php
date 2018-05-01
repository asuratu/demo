<?php
if(!defined('IN_PX')) exit;
return array (
  '/{page:\\d*}' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\ZhCN\\Index',
        '__PROCESS__' => 'search',
        '__REQUEST_MAPPING__' => 'search',
        '__Route' => true,
      ),
      'POST' => 'GET',
      '__STRLEN__' => 2,
      '__REGX__' => '\\/?\\d*',
      '__PARAMS__' => NULL,
      '__PRIORITYS__' => 
      array (
        'page' => '\\d*',
      ),
    ),
  ),
);