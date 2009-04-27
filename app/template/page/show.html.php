<?php
  print "<h1>{$data->title}</h1><p>{$data->body}</p><div class=\"comments\">";
  foreach ($data->comments as $i => $comment) {
    $cclass = ($i % 2) == 0 ? ' h' : '';
    $cclass .= $comment->user_id == $data->user_id ? ' owner' : '';
    print "<div class=\"comment{$cclass}\" id=\"comment-{$comment->id}\"><h2>";
    if ($comment->url) {
      print "<a href=\"{$comment->url}\" class=\"url\">{$comment->name}</a>";
      if ($comment->user_id == $params->user['id'] || $data->user_id == $params->user['id'])
        print "<a href=\"/comment/{$comment->id}/delete\">удалить</a>";
    } else
      print $comment->name;
    print "</h2><p>{$comment->body}</p></div>";
  }
  print '</div>';
?>

<form action="/page/comment" method="post">
  <input type="hidden" name="article_id" value="<?php print $data->id; ?>">
  <div class="post_comment">
    <div class="inner">
      <h2>Есть что сказать?</h2>
      <?php if (!$params->user) { ?>
      <p><label>Твое имя:</label> <input type="text" class="required" name="name"/></p>
      <p class="h"><label>Эл.почта:</label> <input type="text" class="required" name="email"/></p>
      <p><label>URL:</label> <input type="text" name="url"/></p>
      <?php } ?>
      <p class="h"><label>Сообщение:</label> <textarea name="body" rows="10" cols="70"></textarea></p>
      <p class="button"><input type="submit" value="Оставтиь пожелание"/></p>
    </div>
  </div>
</form>