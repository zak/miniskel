<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$routes = Array(
  Array(
    'path' => Array('page','add'),
    'controller' => 'Page',
    'method' => 'add'
  ),
  Array(
    'path' => Array('page','create'),
    'controller' => 'Page',
    'method' => 'create'
  ),
  Array(
    'path' => Array('page','comment'),
    'controller' => 'Page',
    'method' => 'comment'
  ),
  Array(
    'path' => Array('comment', ':id','delete'),
    'controller' => 'Page',
    'method' => 'delete_comment'
  ),
  Array(
    'path' => Array('page',':id', 'edit'),
    'controller' => 'Page',
    'method' => 'edit'
  ),
  Array(
    'path' => Array('page',':id', 'update'),
    'controller' => 'Page',
    'method' => 'update'
  ),
  Array(
    'path' => Array('page',':id', 'delete'),
    'controller' => 'Page',
    'method' => 'delete'
  ),
  Array(
    'path' => Array('page',':id'),
    'controller' => 'Page',
    'method' => 'show'
  ),
  Array(
    'path' => Array('page'),
    'controller' => 'Page',
    'method' => 'index'
  ),
  Array(
    'path' => Array('signup'),
    'controller' => 'Users',
    'method' => 'signup'
  ),
  Array(
    'path' => Array('login'),
    'controller' => 'Users',
    'method' => 'login'
  ),
  Array(
    'path' => Array('logoff'),
    'controller' => 'Users',
    'method' => 'logoff'
  ),
  Array(
    'path' => Array('users'),
    'controller' => 'Users',
    'method' => 'index'
  ),
  Array(
    'path' => Array('user', 'create'),
    'controller' => 'Users',
    'method' => 'create'
  ),
  Array(
    'path' => Array('user', 'edit'),
    'controller' => 'Users',
    'method' => 'edit'
  ),
  Array(
    'path' => Array('user', 'update'),
    'controller' => 'Users',
    'method' => 'update'
  ),
  Array(
    'path' => Array('user',':id'),
    'controller' => 'Users',
    'method' => 'show'
  )
);

?>
