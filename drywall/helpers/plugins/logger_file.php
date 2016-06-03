<?php

namespace Drywall\Helpers\Plugins;

if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

class LoggerFile{
  public function log($level, $message, array $context = array()){
    echo $level.' : '.$message.'<br />';
  }
}
