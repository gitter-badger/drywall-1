<?php

namespace Drywall\Helpers\Traits;

if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

if(!class_exists('LoggerTraits')){
  include_once ROOT.'helpers'.DIR.'traits'.DIR.'logger_traits'.EXT;
}
/**
 * File Framework Interface
 */
interface LoggerFrameworkInterface extends LoggerInterface{
  public function log_error($number, $message, $file, $line);
  public function log_exception($exception);
  public function log_shutdown();
  public function translate($number);
}
/**
 * File Framework Traits
 */
trait LoggerFrameworkTraits{
  use LoggerTraits;
  public function set_handlers(){
    ini_set('display_errors', 0);
    error_reporting(-1);
    set_error_handler(array($this, 'log_error'));
    set_exception_handler(array($this, 'log_exception'));
    register_shutdown_function(array($this, 'log_shutdown'));
  }
  public function log_error($number, $message, $file, $line){
    try{
      throw new \ErrorException($message, $number, 0, $file, $line);
    }
    catch(ErrorException $e){
      return $this->log_exception($e);
    }
  }
  public function log_exception($exception){
    $level = $this->translate($exception->getCode());
    $message = $exception->__toString();
    $this->$level($message);
    return true;
  }
  public function log_shutdown(){
    $error = error_get_last();
    return $this->log_error($error['type'], $error['message'], $error['file'], $error['line']);
  }
  public function log($level, $message, array $context = array()){
    $message = $this->interpolate($message, $context);
    $this->logger->log($level, $message);
  }
  /**
   * Interpolates context values into the message placeholders.
   */
  function interpolate($message, array $context = array())
  {
      // build a replacement array with braces around the context keys
      $replace = array();
      foreach ($context as $key => $val) {
          $replace['{' . $key . '}'] = $val;
      }

      // interpolate replacement values into the message and return
      return strtr($message, $replace);
  }
  public function translate($number){
    $flag = 0;
    for($i=0;$i<=16;$i++){
      if(($number & pow(2, $i)) === pow(2, $i)){
        $flag = $i;
      }
    }
    $flag = pow(2, $flag);
    switch($flag){
      case E_ERROR:
      case E_PARSE:
      case E_CORE_ERROR:
      case E_COMPILE_ERROR:
      case E_USER_ERROR:
        return LogLevel::ALERT;
      break;
      case E_WARNING:
      case E_CORE_WARNING:
      case E_COMPILE_WARNING:
      case E_USER_WARNING:
      case E_RECOVERABLE_ERROR:
        return LogLevel::CRITICAL;
      break;
      case E_NOTICE:
      case E_USER_NOTICE:
      case E_STRICT:
      case E_DEPRECATED:
      case E_USER_DEPRECATED:
        return LogLevel::NOTICE;
      break;
      case E_ALL:
      break;
    }
  }
}
