<?php

/**
 * Базовый класс для контроллеров
 *
 * @author zak
 */
class Controller {
  private $vars;

  // Сборка шаблона
  function build($template=null, $title=null, $data=null, $main=null) {
    $params = ControllerFactory::instance();
    if (isset($main))
      include 'app/template/'.strtolower(get_class($this))."/{$main}";
    else
      include 'app/template/main.html.php';
  }
}
?>
