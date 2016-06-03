<?php
/**
 * Configuration Class
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

if(!class_exists('ConfigFrameworkTraits')){
  include_once ROOT.'helpers'.DIR.'frameworks'.DIR.'config_framework'.EXT;
}

class Config implements Traits\ConfigFrameworkInterface{
  use Traits\ConfigFrameworkTraits;
  protected $dw;
  function __construct($dw){
    $this->dw =& $dw;
  }
}
