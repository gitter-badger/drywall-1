<?php
//namespace Drywall\Controllers;
class Drywall{
  function __construct($dw){
    $this->dw =& $dw;
  }
  function index($params = false){
    echo 'Hello World';
  }
  function http_403($params = false){
    echo '403: Forbidden';
  }
  function http_404($params = false){
    echo '404: Not Found';
  }
  function http_405($params = false){
    echo '405: Method Not Authorized';
  }
  function http_500($params = false){
    echo '500: Server Error';
  }
}
