<?php

namespace Drywall\Helpers\Traits;
/**
 * Kill the Script Immediatly if called directly.
 */
if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

if(!class_exists('ConfigTraits')){
  include_once ROOT.'helpers'.DIR.'traits'.DIR.'config_traits'.EXT;
}

trait ConfigFrameworkTraits{
  use ConfigTraits;
  public function database($key = false){
    return $this->config('database', $key);
  }
  public function router($key = false){
    return $this->config('router', $key);
  }
  protected function config($type, $key = false){
    if(!$this->has($type)){
      $config = $this->dw->file->configs($type, true);
      if(isset($config)){
        $this->set($type, $config[$type]);
      }
    }
    if($key !== false && $this->has($type, $key)){
      return $this->get($type, $key);
    }
    elseif($key === false){
      return (object) $this->get($type);
    }
    else{
      return false;
    }
  }
}

interface ConfigFrameworkInterface extends ConfigInterface{
  public function database($key);
  public function router($key);
}
