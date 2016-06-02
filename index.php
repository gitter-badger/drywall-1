<?php

namespace Drywall;
use Drywall\Helpers\Drywall;

$time = microtime(true);
$memory = memory_get_usage();

/**
 * @global Defines IndieWeb Version
 */
define('DRYWALL', '0.1');
/**
 * @global Sets the Directory Seperator (Platform Dependent)
 */
define('DIR', DIRECTORY_SEPARATOR);
/**
 * @global Defines the Root Directory
 */
define('ROOT', getcwd() . DIR . 'drywall' . DIR);
/**
 * @global Defines the Extension for Includes (Usually '.php' or '.inc')
 */
define('EXT', '.php');

include_once ROOT.'helpers'.DIR.'drywall'.EXT;

$drywall = new Drywall($time, $memory);
$drywall->run();
