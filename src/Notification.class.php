<?php
/**
 * Description of Notification class
 * Класс для оповещений о событиях, например сообщения валидации данных или успешность действия
 *
 * @author zak
 */

class Notification {
  private static $instance;

  public static function instance() {
    if (!isset(self :: $instance)) {
      self :: $instance = new Notification();
    }
    return self :: $instance;
  }

  private $errors = array();
  private $messages = array();

  function message($message) {
    $this->message[] = $message;
  }

  function error($error) {
    $this->error[] = $error;
  }

}
?>

