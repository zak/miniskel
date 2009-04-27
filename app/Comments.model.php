<?php


class Comments extends Model {

  public static function find($arg=null) {
    return parent::find($arg, get_class());
  }
  
}

?>
