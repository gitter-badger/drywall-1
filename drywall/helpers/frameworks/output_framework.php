<?php

namespace Drywall\Helpers\Traits;

if(!defined('DRYWALL')){
  die('Error: Access Denied');
}

if(!class_exists('OutputTraits')){
  include_once ROOT.'helpers'.DIR.'traits'.DIR.'output_traits'.EXT;
}
/**
 * File Framework Interface
 */
interface OutputFrameworkInterface extends OutputInterface{

}
/**
 * File Framework Traits
 */
trait OutputFrameworkTraits{
  use OutputTraits;
}
