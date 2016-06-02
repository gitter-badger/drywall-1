<?php

namespace Drywall\Helpers\Traits;
/**
 * Kill the Script Immediatly if called directly.
 */
if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

interface SessionInterface{
  public function new_session($session_name);
  public function get_session_id();
  public function regenerate_session();
  public function destroy_session();
}

trait SessionTraits{
  private $started = false;
  private $session_variables = array();
  private $session_id = null;
  public function new_session($session_name = 'drywall'){
    session_name($session_name);
    session_set_cookie_params(60*30, '/', 'localhost', true, true);
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
  public function destroy_session(){
    $this->started = (session_destroy()) ? false : true;
    return $this->started;
  }
}
