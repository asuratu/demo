<?php
if(!defined('IN_PX')) exit;
return array (
  'bundles' => 
  array (
    '__ROOT__' => '@data',
    '__DOMAIN__' => '@data',
    'dsn' => '@config',
  ),
  'injects' => 
  array (
    'db' => 'Phoenix\\PXPDO\\Decorator',
  ),
  '__construct' => 
  array (
    0 => 
    array (
      '@bundles' => '__ROOT__',
    ),
    1 => 
    array (
      '@bundles' => '__DOMAIN__',
    ),
    2 => 
    array (
      '@bundles' => 'dsn',
    ),
    3 => 
    array (
      '@injects' => 'db',
    ),
  ),
  '__set' => 0,
);