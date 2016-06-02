<?php
namespace Drywall\Helpers\Traits;
/**
 * Kill the Script Immediatly if called directly.
 */
if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

if(!class_exists('BenchmarkTraits')){
  include_once ROOT.'helpers'.DIR.'traits'.DIR.'benchmark_traits'.EXT;
}

interface BenchmarkFrameworkInterface extends BenchmarkInterface{
  public function start();
  public function end();
  public function time();
  public function memory();
}

trait BenchmarkFrameworkTraits{
  use BenchmarkTraits;
  public function start($time = false, $memory = false){
    return $this->set('start', $time, $memory);
  }
  public function end(){
    return $this->set('end');
  }
  public function total($end = 'end', $start = 'start'){
    if($this->has($start) && $this->has($end)){
      $start = $this->get($start);
      $end = $this->get($end);
      $time = $end->time - $start->time;
      $unit=array('s', 'm', 'h');
      $time = @round($time/pow(1,($i=floor(log($time,1)))),6).' '.$unit[$i];
      $memory = $end->memory - $start->memory;
      $unit=array('b','kb','mb','gb','tb','pb');
      $memory = @round($memory/pow(1024,($i=floor(log($memory,1024)))),2).' '.$unit[$i];
      $total = array('time' => $time, 'memory' => $memory);
      return (object) $total;
    }
    else{
      return false;
    }
  }
  public function time($end = 'end', $start = 'start'){
    if($this->has($start) && $this->has($end)){
      $start = $this->get($start);
      $end = $this->get($end);
      return $end->time - $start->time;
    }
    else{
      return false;
    }
  }
  public function memory($end = 'end', $start = 'start'){
    if($this->has($start) && $this->has($end)){
      $start = $this->get($start);
      $end = $this->get($end);
      $size = $end->memory - $start->memory;
      $unit=array('b','kb','mb','gb','tb','pb');
      return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
    else{
      return false;
    }
  }
}
