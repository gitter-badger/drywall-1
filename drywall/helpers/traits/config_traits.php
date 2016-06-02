<?php

namespace Drywall\Helpers\Traits;
/**
 * Kill the Script Immediatly if called directly.
 */
if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

interface ConfigInterface{
  public function get($type, $key);
  public function set($type, $key, $value);
  public function has($type, $key);
  public function config($type, $key);
}

trait ConfigTraits{
  private $configs = array();
  public function get($type, $key = false){
    if($this->has($type, $key)){
      if($key !== false){
        return $this->config[$type][$key];
      }
      else{
        return $this->config[$type];
      }
    }
    else{
      return false;
    }
  }
  public function set($type, $keys, $value = false){
    if(!is_array($keys) && $value !== false){
      $this->config[$type][$keys] = $value;
      return true;
    }
    else{
      foreach($keys as $key => $value){
        $this->config[$type][$key] = $value;
      }
      return true;
    }
  }
  public function has($type, $key = false){
    if(isset($this->config[$type]) && $key !== false){
      if(isset($this->config[$type][$key])){
        return true;
      }
      else{
        return false;
      }
    }
    elseif(isset($this->config[$type]) && $key === false){
      return true;
    }
    else{
      return false;
    }
  }
}
