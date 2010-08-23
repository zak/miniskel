<form action="/page/<?php print isset($data) ? "{$data->id}/update" : 'create' ?>" method="post">
  <div class="post_comment">
    <div class="inner">
      <h2>Написать заметку.</h2>
      <p class="h">
        <label for="title">Заголовок</label>
        <input class="required" type="text" name="title" value="<?php print isset($data) ? $data->title : '' ?>"/>
      </p>
      <p class="h">
        <label for="public_at">Дата публикации</label>
        <input type="text" name="public_at" value="<?php print isset($data) ? $data->public_at : '' ?>"/>
      </p>
      <p>
        <label for="teaser">Аннонс</label>
        <textarea name="teaser" rows="10" cols="70"><?php print isset($data) ? $data->teaser : '' ?></textarea>
      </p>
      <p>
        <label for="body">Текст</label>
        <textarea name="body" rows="10" cols="70"><?php print isset($data) ? $data->body : '' ?></textarea>
      </p>
      <p class="button"><input type="submit" value="Опубликовать"/></p>
    </div>
  </div>
</form>

