<?php

namespace Drywall\Helpers\Traits;

if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

if(!class_exists('FileTraits')){
  include_once ROOT.'helpers'.DIR.'traits'.DIR.'file_traits'.EXT;
}
/**
 * File Framework Interface
 */
interface FileFrameworkInterface extends FileInterface{
  public function configs($names);
  public function controllers($names);
  public function helpers($names);
  public function models($names);
  public function plugins($names);
  public function tests($names);
  public function traits($names);
  public function views($names);
}
/**
 * File Framework Traits
 */
trait FileFrameworkTraits{
  use FileTraits;
  public function configs($names, $return = false){
    return $this->get('configs', $names, $return);
  }
  public function controllers($names){
    return $this->get('controllers', $names);
  }
  public function frameworks($names){
    return $this->get('helpers'.DIR.'frameworks', $names);
  }
  public function helpers($names){
    return $this->get('helpers', $names);
  }
  public function models($names){
    return $this->get('models', $names);
  }
  public function plugins($names){
    return $this->get('helpers'.DIR.'plugins', $names);
  }
  public function tests($names){
    return $this->get('tests', $names);
  }
  public function traits($names){
    return $this->get('helpers'.DIR.'traits', $names);
  }
  public function views($names){
    return $this->get('views', $names);
  }
}
