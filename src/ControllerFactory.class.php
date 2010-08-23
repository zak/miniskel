<?php

/**
 * Клас для создания контроллера и вызова его метода
 *
 * @author zak
 */
class ControllerFactory {
    private static $instance;
    protected $items = Array('method' => 'index');
    protected $controller;

    function __set($nm, $val) {
      $this->items[$nm] = $val;
    }

    function sets($vals) {
      foreach ($vals as $nm => $val) {
        $this->items[$nm] = $val;
      }
    }

    function __get($nm) {
      return $this->items[$nm];
    }

    function get($nm) {
      return $this->items[$nm];
    }

    function run() {
      self::$instance = $this;

//      print "<br/><b>Controller->run()</b> - ";
//      print_r($this->items);
//      print "<br/>";

      $this->controller = $this->factory($this->get('controller'));
      // before after
      if (method_exists($this->controller, 'before')) call_user_func(Array($this->controller, 'before'), $this->items);
      call_user_func(Array($this->controller, $this->get('method')), $this->items); // надобы передать параметры методу func_get_args()
      //if (method_exists($this->controller, 'after')) call_user_func(Array($this->controller, 'after'), $this->items);
    }

    public static function instance() {
      return self :: $instance;
    }

    function factory($name) {
      if (include_once 'app/' . $name . '.controller.php') {
        return new $name;
      } else {
        throw new Exception ('Controller not found');
      }
    }
}
?>

