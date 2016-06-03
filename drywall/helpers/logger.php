<?php
/**
 * Logger Class
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

if(!class_exists('LoggerFrameworkTraits')){
  include_once ROOT.'helpers'.DIR.'frameworks'.DIR.'logger_framework'.EXT;
}

class Logger implements Traits\LoggerFrameworkInterface{
  use Traits\LoggerFrameworkTraits;
  protected $dw;
  function __construct($dw, $logger){
    $this->dw =& $dw;
    $this->logger =& $logger;
  }
}
