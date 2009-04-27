<?php

/**
 * Description of Dispatcher class
 * Осуществляет разбор URL и вызов соответствующих контроллеров
 *
 * @author zak
 */
require_once 'src/Model.class.php';
require_once 'app/User.model.php';

class Dispatcher {
    protected $request_path = array();
    protected $route_path = array();
    protected $get = array();
    protected $post = array();
    protected $cookie = array();

    function __construct() {
      $request = strtolower($_SERVER['REQUEST_URI']);
      if (strpos($request,'?')) $request = substr($request, 0, strpos($request,'?'));
      $request = trim($request, '/');
      if (strlen($request) == 0) $request = 'page'; // root crutch
      $this->request_path = explode('/', $request);

      include_once 'config/routes.php';
      $this->route_path = $routes;

      $this->get = $_GET;
      $this->post = $_POST;
      $this->cookie = $_COOKIE;

      if(ini_get('magic_quotes_gpc')) {
        $this->get = $this->_stripHttpSlashes($this->get);
        $this->post = $this->_stripHttpSlashes($this->post);
        $this->cookie = $this->_stripHttpSlashes($this->cookie);
      }

//      print('<br/><b>request_path</b> - ');
//      print_r($this->request_path);
//      print('<br/><b>post</b> - ');
//      print_r($this->post);
//      print('<br/><b>get</b> - ');
//      print_r($this->get);
//      print('<br/><b>cookie</b> - ');
//      print_r($this->cookie);
//      print('<br/>');

      $controller = $this->route(new ControllerFactory());
      $controller->post = $this->post;
      $controller->get = $this->get;
      $controller->cookie = $this->cookie;

      $controller->user = User::authenticate_by_cookie($this->cookie['session_token']);
      
      $controller->run();

    }

    // уберает экранирование символов
    protected function _stripHttpSlashes($data, $result=array()) {
      foreach($data as $k => $v) {
        if(is_array($v))
          $result[$k] = $this->_stripHttpSlashes($v);
        else
          $result[$k] = stripslashes($v);
      }
      return $result;
    }

    protected function route($controller) {
      foreach ($this->route_path as $route) {
        if ($route['path'][0] == $this->request_path[0] && count($route['path']) == count($this->request_path)) {
          if (isset($route['controller'])) $controller->controller = $route['controller'];
          if (isset($route['method'])) $controller->method = $route['method'];

//          print('<b>path_match</b> - ');
//          print_r($this->path_match($route['path']));
//          print('<br/><b>request_path</b> - ');
//          print_r($this->request_path);
//          print('<br/><b>path</b> - ');
//          print_r($route['path']);
//          print('<br/><br/>');
          
          if ($options = $this->path_match($route['path'])) break;
          
        }
      }
      $controller->sets($options);

      return $controller;
    }

    protected function path_match($route) {
      $result = array();
      foreach ($route as $i => $r) {
        if ($r{0} == ':') {
          $result[substr($r,1,strlen($r)-1)] = $this->request_path[$i];
        } elseif ($r == $this->request_path[$i]) {
          $result[$r] = $r;
        } elseif ($r != $this->request_path[$i]) {
          $result = false;
          break;
        }
      }
      return $result;
    }

}
?>
