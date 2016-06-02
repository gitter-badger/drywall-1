<?php

namespace Drywall\Helpers\Traits;
/**
 * Kill the Script Immediatly if called directly.
 */
if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

interface InputInterface{
  public function input($name, $type, $filter);
  public function has($name, $type);
  public function clean($string, $filter);
}

trait InputTraits{
  public function input($name, $type = INPUT_GET, $filter = FILTER_SANITIZE_STRING, $options = false){
    if($this->has($name, $type)){
      return filter_input($type, $name, $filter, $options);
    }
    else{
      return false;
    }
  }
  public function has($name, $type = INPUT_GET){
    return filter_has_var($type, $name);
  }
  public function clean($string, $filter = FILTER_SANITIZE_STRING){
    return filter_var($string, $filter);
  }
}
