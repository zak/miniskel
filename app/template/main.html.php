<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title><?php (isset($title)) ? $title.' ' : '' ?>Гостевая книга ))</title>
        <link href="/stylesheets/style.css?1230116979" media="screen" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="main">
          <div id="header">
            <h1 id="title">Тестовое задание "Гостевая книга переросток"</h1>
            <div id="header-nav">
            <?php if ($params->user) { ?>
              <p><a href="/page">Главная</a> | <a href="/page/add">Добавить новую заметку</a> | <a href="/logoff">Выход</a></p>
            <?php } else { ?>
						<div id="header-nav-login-forms">
							<form method="post" action="/login">
								<fieldset>
									<input type="text" onfocus="if(this.value=='login'){this.value='';}; $(this).addClass('normaltext');" maxlength="30" value="login" name="login" class="required login" id="id_login"/>
                  <input type="password" onfocus="if(this.value=='password'){this.value='';}; $(this).addClass('normaltext');" maxlength="128" value="password" name="password" class="required login" id="id_password"/>
                  <input type="submit" style="display: none;" value="»"/>
								</fieldset>
							</form>
              <em><a href="/signup">Регистрация</a></em>
						</div>
						<?php } ?>
					</div>
          </div>
          
          <div id="content">
            <?php if (isset($template)) { include 'app/template/'.strtolower(get_class($this))."/{$template}"; } ?>
          </div>
          <div style="height:71px;"></div>
        </div>

        <div id="footer">
          <div class="wrap">
            Код, дизайн, верстка by Колесников [ZaK] Андрей &copy; 2009
          </div>
        </div>
    </body>
</html>