<?php

namespace Drywall\Helpers\Traits;
/**
 * Kill the Script Immediatly if called directly.
 */
if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

interface OutputInterface{
  public function start($handler);
  public function end();
  public function flush();
  public function header($name, $value);
  public function remove($name);
}

trait OutputTraits{
  private $buffering = false;
  private $callback;
  private $level;
  public function flush(){
    return (ob_flush() && flush()) ? true : false;
  }
  public function end_flush(){
    return (ob_end_flush()) ? true : false;
  }
  public function start($handler = false){
    if($handler !== false && ob_start($handler)){
      $this->buffering = true;
      $this->callback = $handler;
      $this->level = ob_get_level();
      return true;
    }
    elseif(ob_start()){
      $this->buffering = true;
      $this->level = ob_get_level();
      return true;
    }
    else{
      return false;
    }
  }
  public function end(){
    while(ob_get_level() > 0){
      ob_end_flush();
    }
    $this->buffering = false;
  }
  public function header($name, $value){
    return (header($name.': '.$value, true)) ? true : false;
  }
  public function remove($name){
    return (header_remove($name)) ? true : false;
  }
}
