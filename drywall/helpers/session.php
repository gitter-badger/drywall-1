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

if(!class_exists('SessionFrameworkTraits')){
  include_once ROOT.'helpers'.DIR.'frameworks'.DIR.'session_framework'.EXT;
}

class Session implements Traits\SessionFrameworkInterface{
  use Traits\SessionFrameworkTraits;
  protected $dw;
  function __construct($dw){
    $this->dw =& $dw;
    $this->configs();
  }
  public function configs(){
    $configs = (array) $this->dw->config->session();
    foreach($configs as $name => $value){
      $this->$name = $value;
    }
  }
}
