<?php
/**
 * Primary Class
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

class Drywall{
  function __construct($time, $memory){
    mb_language('uni');
    mb_internal_encoding('UTF-8');
    include ROOT.'helpers'.DIR.'file'.EXT;
    $this->file = new File($this);
    $this->file->helpers(array('config', 'benchmark', 'input', 'router', 'output', 'session', 'logger'));
    $this->file->plugins('logger_file');
    $this->config = new Config($this);
    $logger_plugin = new Plugins\LoggerFile;
    $this->logger = new Logger($this, $logger_plugin);
    $this->logger->set_handlers();
    $this->benchmark = new Benchmark($this);
    $this->benchmark->start($time, $memory);
    $this->input = new Input($this);
    $this->output = new Output($this);
    $this->output->start();
    $this->session = new Session($this);
    $this->session->new();
    $this->output->start();
    $this->router = new Router($this);
    $this->benchmark->set('constructer');
  }
  function run(){
    if($this->input->has('footprint', INPUT_COOKIE)){
      $this->session->check();
    }
    $this->router->route();
    $this->output->end_flush();
    $this->benchmark->end();
    $this->logger->info('Total Time: '.$this->benchmark->total()->time.' Total Memory: '.$this->benchmark->total()->memory);
    $this->output->end();
  }
}

/* End of file: drywall.php */
/* File location: drywall/helpers/drywall.php */
