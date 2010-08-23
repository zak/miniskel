<?php


class Comments extends Model {

   protected $fields = array(
    'article_id' => array(),
    'user_id' => array(),
    'name' => array(),
    'email' => array('email'),
    'url' => array(),
    'body' => array(),
    'public' => array(),
    'created_at' => array()
   );

  protected static function getMyClass() {
    return get_class();
  }

}

?>

