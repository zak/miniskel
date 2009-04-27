<?php
/**
 * Description of Model class
 * Базовый клас для моделей приложения
 *
 * @author zak
 */
class Model {
  protected static $classname = __CLASS__;
  private $table;
  private $database;
  private $data = array();
  
  function __set($field, $value) {
    $this->data[$field] = $value;
  }

  function __get($field) {
    return $this->data[$field];
  }

  function __construct($data = null) {
    $this->table = strtolower(get_class($this));
    $this->database = ORM :: instance();
    if (!is_null($data)) {
      $this->data = $data;
    }
  }

  public static function find($arg=null, $class=null) {
    $self_class = (!is_null($class)) ? $class : get_class();
    $table_name = strtolower($self_class);
    $options = '';
    if (isset($arg))
      if (is_array($arg)) {
        foreach ($arg as $op => $v) {
          $options.= " {$op} {$v}";
        }
      } else $options = " WHERE {$arg}";

    $query = "SELECT * FROM {$table_name}".$options;

    $db = ORM :: instance();
    $result = array();
    $query_result = $db->query($query);
    foreach ($query_result as $item) {
      $result[] = new $self_class($item);
    }
    return $result;
  }

  function update_attributes($attributes) {
    $this->data = array_merge($this->data, $attributes);
  }

  function save() {
    $query = "UPDATE {$this->table} SET ";
    foreach ($this->data as $field => $value) {
      $query .= "{$field} = '{$value}', ";
    }
    $this->database->insert_query(rtrim($query, ', ')."WHERE id = {$this->id}");
  }

  function create() {
    $query = "INSERT INTO {$this->table}(".implode(', ', array_keys($this->data)).") VALUES ('".implode('\', \'', array_values($this->data)).'\')';
    $this->data['id'] = $this->database->insert_query($query);
  }

  function delete() {
    $this->database->insert_query("DELETE FROM {$this->table} WHERE id = {$this->id}");
  }

  function select($id=0) {
    $this->data = $this->database->query("SELECT * FROM {$this->table} WHERE id = {$id} LIMIT 1");
  }

}
?>
