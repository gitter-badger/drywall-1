<?php
/**
 * Benchmark Class
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

if(!class_exists('BenchmarkFrameworkTraits')){
  include_once ROOT.'helpers'.DIR.'frameworks'.DIR.'benchmark_framework'.EXT;
}

class Benchmark implements Traits\BenchmarkFrameworkInterface{
  use Traits\BenchmarkFrameworkTraits;
  protected $dw;
  function __construct($dw){
    $this->dw =& $dw;
  }
}
