<?php

namespace Drywall\Helpers\Traits;
/**
 * Kill the Script Immediatly if called directly.
 */
if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

interface SessionInterface{
  public function new_session($name, $time, $path, $domain, $secure, $http);
  public function get_session_id();
  public function regenerate_session();
  public function destroy_session($name);
}

trait SessionTraits{
  private $config = array();
  private $started = false;
  private $session_id = null;
  public function new_session($name, $time, $path, $domain, $secure, $http){
    session_name($name);
    session_set_cookie_params($time, $path, $domain, $secure, $http);
    $this->started = (session_start()) ? true : false;
    if($this->started){
      $this->session_id = $this->get_session_id();
      $this->session_variables[$this->session_id] = array();
      return $this->session_id;
    }
    else{
      return false;
    }
  }
  public function get_session_id(){
    if($this->started){
      return session_id();
    }
    else{
      return false;
    }
  }
  public function regenerate_session(){
    if($this->started){
      return session_regenerate_id(true);
    }
    else{
      return false;
    }
  }
  public function destroy_session($name){
    $params = session_get_cookie_params();
    setcookie($name, '', time() - $params['lifetime'], $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    $this->started = (session_destroy()) ? false : true;
    return $this->started;
  }
}
