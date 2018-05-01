<?php
if(!defined('IN_PX')) exit;
return array (
  'bundles' => 
  array (
    'cfg' => '@config',
    'setting' => '@config',
    '__ROOT__' => '@data',
    '__CDN__' => '@data',
    '__PACKAGE__' => '@data',
    '__LANGUAGE_CONFIG__' => '@data',
    '__LANGUAGE_ID__' => '@data',
    '__ASSETS__' => '@data',
  ),
  'injects' => 
  array (
    'cache' => 'Phoenix\\Cache\\Impl\\CacheImpl',
    'repoCategory' => 'App\\Repository\\Impl\\CategoryImpl',
    'repoArc' => 'App\\Repository\\Impl\\ArchivesImpl',
  ),
);