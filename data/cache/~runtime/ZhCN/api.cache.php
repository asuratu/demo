<?php
if(!defined('IN_PX')) exit;
return array (
  '/archives/view' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\ZhCN\\Api\\Archives',
        '__PROCESS__' => 'view',
        '__REQUEST_MAPPING__' => 'api/archives/view',
        '__ResponseBody' => true,
      ),
      'POST' => 'GET',
      '__STRLEN__' => 14,
    ),
  ),
  '/install' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\ZhCN\\Api\\InstallSql',
        '__PROCESS__' => 'install',
        '__REQUEST_MAPPING__' => 'api/install',
        '__ResponseBody' => true,
      ),
      'POST' => 'GET',
      '__STRLEN__' => 8,
    ),
  ),
  '/form' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\ZhCN\\Api\\ContactForm',
        '__PROCESS__' => 'form',
        '__REQUEST_MAPPING__' => 'api/form',
        '__ResponseBody' => true,
      ),
      'POST' => 'GET',
      '__STRLEN__' => 5,
    ),
  ),
);