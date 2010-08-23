<?php

/**
 * Тестовый контроллер
 *
 * @author zak
 */
include_once 'app/Articles.model.php';
include_once 'app/Comments.model.php';

class Page extends Controller {

  function before($request) {
    $except_page = Array('index', 'show', 'comment');
    if (!in_array($request['method'], $except_page) && $request['user'] == false) {
      Header("Location: /login");
    }
  }

  function index($request) {
    $articles = Articles::paginate((isset($request['get']['page']) ? $request['get']['page'] : 1), 10);
    $this->build('index.html.php', 'Главная', $articles);
  }

  function show($request) {
    $articles = Articles::find("id = {$request['id']}");
    $articles[0]->comments = Comments::find("article_id = {$request['id']}");
    $this->build('show.html.php', $articles[0]->title, $articles[0]);
  }

  function add() {
    $this->build('form.html.php', 'Добавление нового сообщения');
  }

  function create($request) {
    $article = new Articles($request['post']);
    $article->user_id = $request['user']['id'];
    $article->created_at = date('Y-m-d H:i:s');
    if (!isset($request['post']['public_at']) || empty($request['post']['public_at'])) {
      $article->public_at = date('Y-m-d H:i:s');
    }
    $article->create();
    Header("Location: /page/{$article->id}");
  }

  function comment($request) {
    $comment = new Comments($request['post']);
    if ($request['user']) {
      $comment->user_id = $request['user']['id'];
      $comment->name = $request['user']['name'];
      $comment->email = $request['user']['email'];
      $comment->url = '/user/'.$request['user']['id'];
    }
    $comment->create();
    Header("Location: /page/{$comment->article_id}");
  }

  function delete_comment($request) {
    $comment = Comments::find("id = {$request['id']}");
    $comment[0]->delete();
    Header("Location: /page/{$comment[0]->article_id}");
  }

  function edit($request) {
    $articles = Articles::find("id = {$request['id']}");
    $this->build('form.html.php', 'Редактирование: '.$articles[0]->title ,$articles[0]);
  }

  function update($request) {
    $articles = Articles::find("id = {$request['id']}");
    $articles[0]->update_attributes($request['post']);
    $articles[0]->save();
    Header("Location: /page/{$articles[0]->id}");
  }

  function delete($request) {
    $articles = Articles::find("id = {$request['id']}");
    $articles[0]->delete();
    Header("Location: /page");
  }
}
?>

