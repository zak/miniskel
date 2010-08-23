<?php

/*
 * Предварительные настройки для приложения
 */

 if (!file_exists('./config/database.php')) {

   if (isset($_POST['host']) && isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['name']) &&
      ($db = mysql_connect($_POST['host'], $_POST['user'], $_POST['pass'])) &&
      (mysql_select_db($_POST['name'], $db))) {
     $database = array(
       'host' => $_POST['host'],
       'user' => $_POST['user'],
       'pass' => $_POST['pass'],
       'name' => $_POST['name']
     );
     $conf = var_export($database, true);
     $file = fopen('./config/database.php', 'w');
     fwrite($file, '<?php $database = '.$conf.' ?>');
     fclose($file);
     mysql_query("SET NAMES UTF-8", $db);

     $createArticle = "CREATE TABLE IF NOT EXISTS  `miniskel`.`articles` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `user_id` int(12) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `teaser` text NOT NULL,
  `body` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `public_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8";
     mysql_query($createArticle, $db) or die(mysql_error());

     $createComment = "CREATE TABLE IF NOT EXISTS  `comments` (
  `id` int(12) NOT NULL auto_increment,
  `article_id` int(12) default NULL,
  `user_id` int(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
     mysql_query($createComment, $db) or die(mysql_error());

     $createUser = "CREATE TABLE IF NOT EXISTS  `users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `session_token_expires_at` int(12) NOT NULL,
  `session_token` varchar(32) NOT NULL,
  `session_expires_time_shift` int(11) NOT NULL default '21600',
  `session_ip` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
     mysql_query($createUser, $db) or die(mysql_error());

     Header("Location: /");
   }
   //print('<h1>Нету database.php</h1>');
   $title = 'Установка';
   $template = 'setup.html.php';
   $classname = 'system';
   include 'app/template/main.html.php';
   exit;
 }


?>

