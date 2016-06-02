<?php
/**
 * File Class
 *
 * @package Drywall
 * @subpackage Helpers
 * @author Matthew Knowlton
 * @copyright Copyright (c) 2016 Matthew Knowlton codemonkey@openmailbox.org
 * @link https://drywall.wordpress.com/
 */
namespace Drywall\Helpers;
/**
 * Kill the Script Immediatly if called directly.
 */
if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

if(!class_exists('RouterFrameworkTraits')){
  include_once ROOT.'helpers'.DIR.'framework'.DIR.'router_framework'.EXT;
}

class Router implements Traits\RouterFrameworkInterface{
  use Traits\RouterFrameworkTraits;
  protected $dw;
  protected $config;
  function __construct($dw){
    $this->dw =& $dw;
    $this->config = $this->dw->config->router();
    foreach($this->config as $route){
      $this->add($route['method'], $route['route'], $route['path'], $route['name']);
    }
  }
}
