<?php
if(!defined('IN_PX')) exit;
return array (
  '/userContent' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\Admin\\Setting\\Content',
        '__PROCESS__' => 'userContent',
        '__REQUEST_MAPPING__' => 'setting/userContent',
      ),
      'POST' => 'GET',
      '__STRLEN__' => 12,
    ),
  ),
  '/roleContent' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\Admin\\Setting\\Content',
        '__PROCESS__' => 'roleContent',
        '__REQUEST_MAPPING__' => 'setting/roleContent',
      ),
      'POST' => 'GET',
      '__STRLEN__' => 12,
    ),
  ),
  '/content' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\Admin\\Setting\\Content',
        '__PROCESS__' => 'content',
        '__REQUEST_MAPPING__' => 'setting/content',
      ),
      'POST' => 'GET',
      '__STRLEN__' => 8,
    ),
  ),
);