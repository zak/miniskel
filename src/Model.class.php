<?php
/**
 * Description of Model class
 * Базовый клас для моделей приложения
 *
 * @author zak
 */

class Validation {
  public static function numeric($data) {
    if (is_numeric($data))
      return true;
    else
      return 'Должно быть число';
  }

  public static function email($data) {
    if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$", $data))
      return true;
    else
      return 'Формат email не верен.';
  }
}

class Model {

  //protected static $classname = __CLASS__;
  private $table;
  private $database;
  private $data = array();
  // description fields
  protected $fields = array();
  private $errors = array();

  function validate($validator, $value, $field) {
    if (method_exists($this, $validator))
      $result = call_user_func(Array($this, $validator), $value);
    elseif (method_exists('Validation', $validator))
      $result = call_user_func(Array('Validation', $validator), $value);
    if ($result !== true)
      $this->errors[] = array($field => $result);
    else
      $this->data[$field] = $value;
  }

  function __set($field, $value) {
    if ((array_key_exists($field, $this->fields)) && (!empty($this->fields[$field]))) {
      if (is_array($fields[$field]))
        // добавить проверку ключа на нумерик и если нет вызывать валидатор по ключю передавая значения в функцию валидации
        foreach ($this->fields[$field] as $validator) {
          validate($validator, $value, $field);
        }
      else
        validate($this->fields[$field], $value, $field);
    } else
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

  // Получение своего класса, перенаследовать в моделях
  protected static function getMyClass() {
    return (get_class());
  }

  public static function find($arg=null) {
    $self_class = static::getMyClass();
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

  public static function first($id=0) {
    $result = static::find(array('id =' => $id));
    if (!empty($result)) {
      $result = $result[0];
    }
    return $result;
    //$this->data = $this->database->query("SELECT * FROM {$this->table} WHERE id = {$id} LIMIT 1");
  }

  // переписать на вызов сет для каждого атребута
  function update_attributes($attributes) {
    $this->data = array_merge($this->data, $attributes);
  }

  // сохранение изменений
  function save() {
    if (empty($this->arrors)) {
      $query = "UPDATE {$this->table} SET ";
      var_dump($this->fields);
      var_dump($this->data);
      foreach ($this->fields as $field => $_) {
        if (isset($this->data[$field])) {
          $value = mysql_real_escape_string($this->data[$field]);
          $query .= "{$field} = '{$value}', ";
        }
      }
      $this->database->insert_query(rtrim($query, ', ')."WHERE id = {$this->id}");
      $this->errors = array();
      return true;
    } else
      return $this->errors;
  }

  // создание новой записи
  function create() {
    if (empty($this->arrors)) {
      $query = "INSERT INTO `{$this->table}`(".implode(', ', $this->escape_array_keys($this->data)).") VALUES ('".implode('\', \'', $this->escape_array_values($this->data)).'\')';
      $this->data['id'] = $this->database->insert_query($query);
      return true;
    } else
      return $this->errors;
  }

  function delete() {
    $this->database->insert_query("DELETE FROM {$this->table} WHERE id = {$this->id}");
  }

  protected function escape_array($array) {
      return array_map(mysql_real_escape_string, $array);
  }

  protected function escape_array_keys($array) {
      return $this->escape_array(array_keys($array));
  }

  protected function escape_array_values($array) {
      return $this->escape_array(array_values($array));
  }

}
?>

