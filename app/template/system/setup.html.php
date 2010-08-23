<ul>
  <li>PHP 5.3 - <?php $version = phpversion(); print '<span>'.$version.'</span>'; $req = strpos($version, '5.3.'); print ' - <span class="system'.($req === false ? ' red' : ' green').'">'.($req === false ? 'r' : 'a').'</span>'; ?></li>
  <li>MySQL 5.1</li>
</ul>
<form action="/" method="post">
  <div class="post_comment">
    <div class="inner">
      <h2>Данные для подключения к базе данных.</h2>
      <p class="h">
        <label for="host">Host</label>
        <input class="required" type="text" name="host" value="<?php print isset($data) ? $data->host : '' ?>"/>
      </p>
      <p class="h">
        <label for="user">User</label>
        <input class="required" type="text" name="user" value="<?php print isset($data) ? $data->user : '' ?>"/>
      </p>
      <p class="h">
        <label for="pass">Password</label>
        <input class="required" type="text" name="pass" value="<?php print isset($data) ? $data->pass : '' ?>"/>
      </p>
      <p class="h">
        <label for="name">Database name</label>
        <input class="required" type="text" name="name" value="<?php print isset($data) ? $data->name : '' ?>"/>
      </p>
      <p class="button"><input type="submit" value="Сохранить"/></p>
    </div>
  </div>
</form>

