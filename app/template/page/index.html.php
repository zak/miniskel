<?php

  foreach($data as $op => $article) {
    if ($op === 'page') continue;
    $action = '';
    if ($params->user && $article->user_id == $params->user['id'])
      $action = <<<EOD
        <div class="actions">
          <a href="/page/{$article->id}/edit">Редактировать</a>
          <a href="/page/{$article->id}/delete">Удалить</a>
        </div>
EOD;
    $content = $article->teaser == '' ? $article->body : $article->teaser;
    print <<<EOD
      <div id="article-{$article->id}" class="article">
        <h2><a href="/page/{$article->id}">{$article->title}</a></h2>
        <span class="data">{$article->public_at}</span>
        <span class="author"></span>
        {$action}
        <p>{$content}</p>
      </div>
EOD;
  }

  //вынести в метод
  if ((integer)$data['page']['total_page'] > 1) {
    print '<div class="paginate"><ul class="paginator">';
    if ((integer)$data['page']['page'] > 1)
      print '<li><a href="?page='.($data['page']['page'] - 1).'">&lt;&lt;</a></li>';
    else
      print '<li class="disable">&lt;&lt;</li>';

    for ($page = 1; $page <= $data['page']['total_page']; $page++)
      if ($page == (integer)$data['page']['page'])
        print "<li class=\"current\">{$page}</li>";
      else
        print "<li><a href=\"?page={$page}\">{$page}</a></li>";

    if ((integer)$data['page']['page'] < (integer)$data['page']['total_page'])
      print '<li><a href="?page='.($data['page']['page'] + 1).'">&gt;&gt;</a></li>';
    else
      print '<li class="disable">&gt;&gt;</li>';

    print '</ul></div>';
  }

?>