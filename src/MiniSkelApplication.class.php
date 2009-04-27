<?php
/**
 * MiniSkelApplicationclass клас реализующий приложение
 * основная задача запуск диспетчера и конект к базе
 *
 * @author zak
 */
require_once 'src/ORM.class.php';
require_once 'src/Dispatcher.class.php';

require_once 'src/Model.class.php';
require_once 'src/Controller.class.php';
require_once 'src/ControllerFactory.class.php';

class MiniSkelApplication {

    // Метод запускающий приложение на выполнение
    function process() {
//      $database = new ORM();
      $dispatcher = new Dispatcher();
    }

}
?>
