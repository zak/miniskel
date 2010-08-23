<?php
/**
 * Description of Users
 *
 * @author zak
 */
class User extends Model {

  protected static function getMyClass() {
    return get_class();
  }

  public static function signup($params) {
    $db = ORM::instance();
    $query_result = $db->query("SELECT * FROM users WHERE login = '{$params['login']}' OR email = '{$params['email']}'");
    if (count($query_result) == 0) {
      $salt = md5(time());
      $password = md5($params['password'].$salt);
      $user_id = $db->insert_query("INSERT INTO users (login, password, salt, email) VALUES ('{$params['login']}','{$password}','{$salt}','{$params['email']}')");
      return true;
    } else {
      return false; // 'Логин или эл.адресс не уникален.';
    }
  }

  public static function authenticate($login, $pass) {
    $table_name = 'users';
    $query = "SELECT * FROM {$table_name} WHERE login = '{$login}' LIMIT 0, 1";

    $db = ORM::instance();
    $query_result = $db->query($query);
    //$user = $query_result[0];
    if ((!empty($query_result)) && ($user = $query_result[0]) && ($user['password'] == md5($pass.$user['salt']))) {
      $session_token = md5(base64_encode(time()).$user['salt']);

      $db->insert_query("UPDATE {$table_name} SET session_token = '{$session_token}', session_token_expires_at = '".(time()+$user['session_expires_time_shift']).'\', session_ip = \''.$_SERVER['REMOTE_ADDR']."' WHERE id = '{$user['id']}'");
      setcookie("session_token", $session_token, time()+$user['session_expires_time_shift']);
      return true;
    } else return false;
  }

  public static function authenticate_by_cookie($session_token) {
    if (strlen($session_token) == 0) return false;
    $db = ORM::instance();
    $query_result = $db->query("SELECT * FROM users WHERE session_token = '{$session_token}'");
    $user = $query_result[0];
    if ($user && $user['session_token_expires_at'] > time() && $user['session_ip'] == $_SERVER['REMOTE_ADDR']) {
      $db->insert_query("UPDATE users SET session_token_expires_at = '".(time()+$user['session_expires_time_shift'])."' WHERE id = '{$user['id']}'");
      return $user;
    } else return false;
  }
}
?>

