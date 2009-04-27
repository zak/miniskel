<ul class="users">
<?php

  foreach($data as $user) {
    print <<<EOD
      <li id="user-{$user->id}">
        <a href="/user/{$user->id}">{$user->login}</a>
      </li>
EOD;
  }

?>
</ul>