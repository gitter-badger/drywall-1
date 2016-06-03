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
  public function session($name, $filter, $options);
  public function set_session($name, $value, $filter, $options);
  public function unset_session($name);
  public function set_cookie($name, $value, $time, $directory, $domain, $secure, $http);
  public function unset_cookie($name, $value, $time, $directory, $domain, $secure, $http);
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
  public function session($name, $filter = DEFAULT_FILTER, $options = DEFAULT_OPTIONS){
    if(isset($_SESSION[$name])){
      return $this->clean($_SESSION[$name], $filter, $options);
    }
    else{
      return false;
    }
  }
  public function set_session($name, $value, $filter = DEFAULT_FILTER, $options = DEFAULT_OPTIONS){
    $value = $this->clean($value, $filter, $options);
    return ($_SESSION[$name] = $value) ? true : false;
  }
  public function unset_session($name){
    unset($_SESSION[$name]);
    return (isset($_SESSION[$name])) ? true : false;
  }
  public function set_cookie($name, $value, $time, $directory, $domain, $secure, $http){
    return setcookie($name, $value, time() + $time, $directory, $domain, $secure, $http);
  }
  public function unset_cookie($name, $value, $time, $directory, $domain, $secure, $http){
    return setcookie($name, $value, time() - $time, $directory, $domain, $secure, $http);
  }
}
