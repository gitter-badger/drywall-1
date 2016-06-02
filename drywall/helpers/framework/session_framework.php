<?php

namespace Drywall\Helpers\Traits;

if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

if(!class_exists('SessionTraits')){
  include_once ROOT.'helpers'.DIR.'traits'.DIR.'session_traits'.EXT;
}
/**
 * File Framework Interface
 */
interface SessionFrameworkInterface extends SessionInterface{
  public function new();
  public function check();
  public function destroy();
  public function footprint($return);
  public function variable($name, $value);
  public function unset_variable($name);
}
/**
 * File Framework Traits
 */
trait SessionFrameworkTraits{
  use SessionTraits;
  private $variables = array();
  public function new(){
    $session_id = $this->new_session($this->name, $this->time, $this->path, $this->domain, $this->secure, $this->http);
    if(!$this->dw->input->has($this->footprint_name, INPUT_COOKIE)){
      $this->footprint();
      $this->variable('LAST_ACTIVITY', time());
      return true;
    }
    else{
      return true;
    }
  }
  public function check(){
    $cookie = $this->dw->input->cookie($this->footprint_name);
    $expected_value = $this->footprint(true);
    $last_activity = $this->variable('LAST_ACTIVITY');
    $timeout = time() - $last_activity;
    if(strcmp($cookie, $expected_value) === 0 && $timeout < 60*30){
      $this->variable('LAST_ACTIVITY', time());
      return true;
    }
    else{
      $this->regenerate_session();
      $this->variable('LAST_ACTIVITY', time());
      $this->footprint();
      return false;
    }
  }
  public function destroy(){
    if($this->unset_variable() && $this->destroy_session($this->name) && $this->dw->input->unset_cookie($this->footprint_name, $value, $this->footprint_time, $this->footprint_path, $this->footprint_domain, $this->footprint_http, $this->footprint_secure)){
      return true;
    }
    else{
      return false;
    }
  }
  public function footprint($return = false){
    $session_id = $this->get_session_id();
    $user_ip = $this->dw->input->server('REMOTE_ADDR');
    $user_agent = $this->dw->input->server('HTTP_USER_AGENT');
    $value = sha1($user_agent+$user_ip+$session_id+'SaltGoesHere');
    if($return !== false){
      return $value;
    }
    elseif($this->dw->input->set_cookie($this->footprint_name, $value, $this->footprint_time, $this->footprint_path, $this->footprint_domain, $this->footprint_http, $this->footprint_secure)){
      return true;
    }
    else{
      return false;
    }
  }
  public function variable($name, $value = null){
    if($value !== null){
      $this->variables[$name] = $value;
      return ($this->dw->input->set_session($name, $value)) ? true : false;
    }
    else{
      return $this->dw->input->session($name);
    }
  }
  public function unset_variable($name = null){
    if($name !== null){
      unset($this->variables[$name]);
      return (isset($this->variables[$name]) && $this->unset_session($name)) ? true : false;
    }
    else{
      foreach($this->variables as $name => $value){
        unset($this->variables[$name]);
        $this->unset_session($name);
      }
      return empty($this->variables) ? true : false;
    }
  }
}
