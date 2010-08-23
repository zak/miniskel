<?php

/**
 * Description of Articles model
 *
 * @author zak
 */
class Articles extends Model {

  protected $fields = array(
    'title' => array(),
    'teaser' => array(),
    'body' => array(),
    'user_id' => array('numeric'),
    'public_at' => array(),
    'created_at' => array(),
    'updated_at' => array()
  );

  protected static function getMyClass() {
    return get_class();
  }

  public static function paginate($page, $per_page) {
    $result = self::find(array('WHERE' => 'public_at < NOW()', 'ORDER BY' => 'updated_at DESC', 'LIMIT' => (($page - 1) * $per_page).','.$per_page));
    $count = ORM::instance()->query('SELECT COUNT(*) AS count FROM articles');
    $total = $count[0]['count'];
    $result['page'] = array('page'=>$page, 'total_entries' => $total, 'total_page' => (integer)($total / $per_page)+1);
    return $result;
  }

  function user() {
    return User::find("id = {$this->user_id}");
  }

}
?>

