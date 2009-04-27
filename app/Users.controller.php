<?php

/**
 * Description of Users controller
 *
 * @author zak
 */
include_once 'app/User.model.php';

class Users extends Controller {

  function signup() {
    $this->build('signup.html.php');
  }

  function create($request) {
    if (User::signup($request['post']))
      Header("Location: /login");
    else
     $this->build('signup.html.php', 'Регистрация');
  }

  function login($request) {
    if (User::authenticate($request['post']['login'], $request['post']['password'])) {
      Header("Location: /page");
    } else {
      $this->build('login.html.php', 'Вход');
    }
  }

  function logoff($request) {
    setcookie("session_token");
    Header("Location: /page");
  }

  function index() {
    $users = User::find();
    $this->build('index.html.php', 'Список пользователей', $users);
  }

  function show($request) {

  }

  function edit($request) {

  }

  function update($request) {

  }
}
?>
