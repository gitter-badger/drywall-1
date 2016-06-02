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
}
/**
 * File Framework Traits
 */
trait SessionFrameworkTraits{
  use SessionTraits;
  public function new(){
    $session_id = $this->new_session('drywall');
    if(!$this->dw->input->has('footprint', INPUT_COOKIE)){
      $this->footprint();
      $this->session_variable('LAST_ACTIVITY', time());
      return true;
    }
    else{
      return true;
    }
  }
  public function check(){
    $cookie = $this->dw->input->cookie('footprint');
    $expected_value = $this->footprint(true);
    $last_activity = $this->session_variable('LAST_ACTIVITY');
    $timeout = time() - $last_activity;
    echo $timeout;
    if(strcmp($cookie, $expected_value) === 0 && $timeout < 60*30){
      $this->session_variable('LAST_ACTIVITY', time());
      return true;
    }
    else{
      $this->regenerate_session();
      $this->session_variable('LAST_ACTIVITY', time());
      $this->footprint();
      return false;
    }
  }
  public function destroy(){
    if($this->destroy_session() && $this->dw->input->unset_cookie('footprint')){
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
    elseif($this->dw->input->set_cookie('footprint', $value)){
      return true;
    }
    else{
      return false;
    }
  }
}
