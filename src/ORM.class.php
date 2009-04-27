<?php
/**
 * Description of ORM class
 * Осуществляет доступ к базе данных
 *
 * @author zak
 */
class ORM {
  // singelton object
  private static $instance;
  // db_connect
  protected $db;

  // returns current default database connection object
  public static function instance() {
    if (!isset(self :: $instance)) {
      self :: $instance = new ORM();
    }
    return self :: $instance;
  }

  function __construct() {
    require_once 'config/database.php';

    $this->db = mysql_connect($database['host'], $database['user'], $database['pass']) or die("Ошибка подключения ". mysql_error());
    mysql_select_db($database['name'], $this->db);
    mysql_query("SET NAMES UTF-8", $this->db);
  }

  function __destruct() {
    mysql_close($this->db);
  }

  /* Выполняет запрос к базе и возвращает ассоциированный массив */
  function query($sql) {
//    print '<br/><b>SQL</b> - '.$sql.'<br/>';
    $result = array();
    $q = mysql_query($sql, $this->db) or die(mysql_error());
    while($r = mysql_fetch_array($q, MYSQL_ASSOC)) {
      $result[] = $r;
    }
    return $result;
  }

  function insert_query($sql) {
//    print '<br/><b>SQL</b> - '.$sql.'<br/>';
    mysql_query($sql, $this->db) or die(mysql_error());
    return mysql_insert_id($this->db);
  }

  function info() {
    return mysql_info($this->db);
  }


}
?>
