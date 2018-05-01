<?php
if(!defined('IN_PX')) exit;
return array (
  'bundles' => 
  array (
    'dsn' => '@config',
  ),
  'injects' => 
  array (
    'cache' => 'Phoenix\\Cache\\Impl\\CacheImpl',
  ),
  '__construct' => 
  array (
    0 => 
    array (
      '@bundles' => 'dsn',
    ),
    1 => 
    array (
      '@injects' => 'cache',
    ),
    2 => 
    array (
      '@property' => 'lazy',
    ),
  ),
  'property' => 'Phoenix\\PXPDO\\Decorator',
);