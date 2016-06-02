<?php
namespace Drywall\Helpers\Traits;
/**
 * Kill the Script Immediatly if called directly.
 */
if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

interface BenchmarkInterface{
  public function get($name);
  public function set($name, $time, $memory);
  public function has($name);
}

trait BenchmarkTraits{
  private $benchmarks = array();
  public function get($name){
    if($this->has($name)){
      return (object) $this->benchmarks[$name];
    }
    else{
      return false;
    }
  }
  public function set($name, $time = false, $memory = false){
    $time = ($time) ? $time : microtime(true);
    $memory = ($memory) ? $memory : memory_get_usage();
    $this->benchmarks[$name] = array('time' => $time, 'memory' => $memory);
    return $this->has($name);
  }
  public function has($name){
    if(isset($this->benchmarks[$name]) && is_array($this->benchmarks[$name])){
      return true;
    }
    else{
      return false;
    }
  }
}
