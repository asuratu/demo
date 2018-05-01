<?php
if(!defined('IN_PX')) exit;
return array (
  'bundles' => 
  array (
    '__PACKAGE__' => '@data',
    '__ROOT__' => '@data',
    '__RM__' => '@data',
    'setting' => '@config',
    'cfg' => '@config',
    '__LANGUAGE_ID__' => '@data',
  ),
  'injects' => 
  array (
    'session' => 'Phoenix\\Session\\Impl\\SessionImpl',
    'servArc' => 'App\\Service\\Impl\\ArchivesImpl',
    'repoArc' => 'App\\Repository\\Impl\\ArchivesImpl',
    'category' => 'App\\Repository\\Impl\\CategoryImpl',
  ),
  '__route' => 0,
);