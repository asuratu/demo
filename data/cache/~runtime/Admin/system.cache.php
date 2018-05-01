<?php
if(!defined('IN_PX')) exit;
return array (
  '/statistics' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\Admin\\System\\Statistics',
        '__PROCESS__' => 'statistics',
        '__REQUEST_MAPPING__' => 'system/statistics',
      ),
      'POST' => 'GET',
      '__STRLEN__' => 11,
    ),
  ),
  '/welcome' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\Admin\\System\\Statistics',
        '__PROCESS__' => 'welcome',
        '__REQUEST_MAPPING__' => 'system/welcome',
      ),
      'POST' => 'GET',
      '__STRLEN__' => 8,
    ),
  ),
  '/upload' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\Admin\\System\\Upload',
        '__PROCESS__' => 'upload',
        '__REQUEST_MAPPING__' => 'system/upload',
        '__Route' => true,
      ),
      'POST' => 'GET',
      '__STRLEN__' => 7,
    ),
  ),
  '/login' => 
  array (
    0 => 
    array (
      'GET' => 
      array (
        '__CONTROLLER_CLASS__' => 'App\\Admin\\System\\Login',
        '__PROCESS__' => 'login',
        '__REQUEST_MAPPING__' => 'system/login',
      ),
      'POST' => 'GET',
      '__STRLEN__' => 6,
    ),
  ),
);