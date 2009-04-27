<form action="/page/<?php print isset($data) ? "{$data->id}/update" : 'create' ?>" method="post">
  <div class="post_comment">
    <div class="inner">
      <h2>Написать заметку.</h2>
      <p class="h"><label>Заголовок</label><input class="required" type="text" name="title" value="<?php print isset($data) ? $data->title : '' ?>"/></p>
      <p><label>Текст</label><textarea name="body" rows="10" cols="70"><?php print isset($data) ? $data->body : '' ?></textarea></p>
      <p class="button"><input type="submit" value="Опубликовать"/></p>
    </div>
  </div>
</form>
