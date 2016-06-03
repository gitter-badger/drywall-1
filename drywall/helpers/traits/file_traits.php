<?php

namespace Drywall\Helpers\Traits;

if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

/**
 * File interface
 */
interface FileInterface{
  public function get($type, $names);
  public function has($type, $name);
  public function exists($type, $name);
  public function name($type, $name);
}
/**
 * File Traits
 */
trait FileTraits{
  private $loaded = array();
  public function get($type, $names, $return = false){
    if(!is_array($names)){
      $names = (array) $names;
    }
    foreach($names as $name){
      if($this->has($type, $name) || !$this->exists($type, $name)){
          return false;
      }
      else{
        include_once $this->name($type, $name);
        if($return === true && isset($config)){
          return $config;
        }
        $this->loaded[$type][] = $name;
      }
    }
    if($return !== true){
      return true;
    }
  }
  public function exists($type, $name){
    if(file_exists($this->name($type, $name))){
      return true;
    }
    else{
      return false;
    }
  }
  public function has($type, $name){
    if(isset($this->loaded[$type]) && in_array($name, $this->loaded[$type])){
      return true;
    }
    else{
      return false;
    }
  }
  public function name($type, $name){
    if(mb_strpos(ROOT, $type) !== false){
      return ROOT.$name.EXT;
    }
    else {
      return ROOT.$type.DIR.$name.EXT;
    }
  }
  public function loaded(){
    return $this->loaded;
  }
}
