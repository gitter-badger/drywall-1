<?php

namespace Drywall\Helpers\Traits;

if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

if(!class_exists('InputTraits')){
  include_once ROOT.'helpers'.DIR.'traits'.DIR.'input_traits'.EXT;
}

define('DEFAULT_FILTER', FILTER_SANITIZE_STRING);
define('DEFAULT_OPTIONS', false);
/**
 * File Framework Interface
 */
interface InputFrameworkInterface extends InputInterface{
  public function get($name, $filter, $options);
  public function post($name, $filter, $options);
  public function cookie($name, $filter, $options);
  public function server($name, $filter, $options);
  public function enviroment($name, $filter, $options);
  public function set_cookie($name, $value, $time, $domain, $directory);
}
/**
 * File Framework Traits
 */
trait InputFrameworkTraits{
  use InputTraits;
  public function get($name, $filter = DEFAULT_FILTER, $options = DEFAULT_OPTIONS){
    return $this->input($name, INPUT_GET, $filter, $options);
  }
  public function post($name, $filter = DEFAULT_FILTER, $options = DEFAULT_OPTIONS){
    return $this->input($name, INPUT_POST, $filter, $options);
  }
  public function cookie($name, $filter = DEFAULT_FILTER, $options = DEFAULT_OPTIONS){
    return $this->input($name, INPUT_COOKIE, $filter, $options);
  }
  public function server($name, $filter = DEFAULT_FILTER, $options = DEFAULT_OPTIONS){
    return $this->input($name, INPUT_SERVER, $filter, $options);
  }
  public function enviroment($name, $filter = DEFAULT_FILTER, $options = DEFAULT_OPTIONS){
    return $this->input($name, INPUT_ENVIROMENT, $filter, $options);
  }
  public function set_cookie($name, $value, $time = 60*30, $domain = 'localhost', $directory = '/'){
    return setcookie($name, $value, time() + $time, $directory, $domain, true, true);
  }
  public function unset_cookie($name, $value = '', $time = 60*30, $domain = 'localhost', $directory = '/'){
    return setcookie($name, '', time() - $time, $directory, $domain, true, true);
  }
}