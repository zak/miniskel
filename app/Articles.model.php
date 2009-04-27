<?php

/**
 * Description of Articles model
 *
 * @author zak
 */
class Articles extends Model {

  public static function find($arg=null) {
    return parent::find($arg, get_class());
  }

  public static function paginate($page, $per_page) {
    $result = self::find(array('LIMIT' => (($page - 1) * $per_page).','.$per_page,));
    $count = ORM::instance()->query('SELECT COUNT(*) AS count FROM articles');
    $total = $count[0]['count'];
    $result['page'] = array('page'=>$page, 'total_entries' => $total, 'total_page' => (integer)($total / $per_page)+1);
    return $result;
  }

}
?>
