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

if(!class_exists('InputFrameworkTraits')){
  include_once ROOT.'helpers'.DIR.'framework'.DIR.'input_framework'.EXT;
}

class Input implements Traits\InputFrameworkInterface{
  use Traits\InputFrameworkTraits;
  protected $dw;
  function __construct($dw){
    $this->dw =& $dw;
  }
}
