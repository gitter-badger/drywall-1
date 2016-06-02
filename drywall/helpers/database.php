<?php
/**
 * Database Class
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

class Database{
  protected $dw;
  function __construct($dw){
    $this->dw = $dw;
  }
}
