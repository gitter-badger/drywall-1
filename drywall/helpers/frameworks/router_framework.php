<?php

namespace Drywall\Helpers\Traits;
/**
 * Kill the Script Immediatly if called directly.
 */
if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

if(!class_exists('RouterTraits')){
  include_once ROOT.'helpers'.DIR.'traits'.DIR.'router_traits'.EXT;
}

/**
 * Router Framework Interface
 */
interface RouterFrameworkInterface extends RouterInterface{
  public function route();
}
/**
 * Router Framework Traits
 */
trait RouterFrameworkTraits{
  use RouterTraits;
  private $not_found = array();
  function route(){
    $uri = $this->dw->input->server('REQUEST_URI') ?: '/';
    $method = $this->dw->input->server('REQUEST_METHOD') ?: 'GET';
    $match = $this->match($uri, $method);
    if($match === false){
      $match = array('target' => $this->get('404'), 'params' => array());
    }
    list($controller, $method) = explode('/', $match['target']);
    return $this->call($controller, $method, $match['params']);
  }
  function call($controller, $method, $params = array()){
    if(!class_exists($controller)){
      if($this->dw->file->controllers($controller)){
        $$controller = new $controller($this->dw);
        $$controller->$method($params);
      }
    }
    else{
      $$controller = new $controller($this->dw);
      $$controller->$method();
    }
  }
}
