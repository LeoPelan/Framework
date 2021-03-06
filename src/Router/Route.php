<?php

/**
 * Article
 * Definition de la classe Route
 *
 * @package     Framework
 * @subpackage  Router
 * @category    classes
 * @author     Leo
 */

namespace App\Router;

class Route
{

  private $path;
  private $callable;
  private $matches = [];

  function __construct($path, $callable)
  {
    $this->path = trim($path, '/');
    $this->callable = $callable;
  }

  public function match($url){
      $url = trim($url, '/');
      $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
      $regex = "#^$path$#i";
      if(!preg_match($regex, $url, $matches)){
          return false;
      }
      array_shift($matches);
      $this->matches = $matches;
      return true;
  }

  private function paramMatch($match){
      if(isset($this->params[$match[1]])){
          return '(' . $this->params[$match[1]] . ')';
      }
      return '([^/]+)';
  }

  public function call(){
    if(is_string($this->callable)){
        $params = explode('#', $this->callable);
        $controller = "App\\Controller\\" . $params[0] . "Controller";
        $controller = new $controller();
        $access_log = __DIR__.'/../../log/access.log';
        $accessUrl = $_SERVER['REQUEST_URI'];
        date_default_timezone_set('Europe/Paris');
        $data = "\n".date('d/m/Y == H:i:s')." -> ".$accessUrl;
        file_put_contents($access_log, $data, FILE_APPEND);
        return call_user_func_array([$controller, $params[1]], $this->matches);
    } else {
        return call_user_func_array($this->callable, $this->matches);
    }
}

  public function getUrl($params){
    $path = $this->path;
    foreach($params as $k => $v){
        $path = str_replace(":$k", $v, $path);
    }
    return $path;
}
}
