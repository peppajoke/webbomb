<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/4/2018
 * Time: 4:06 PM
 */

namespace webBomb\database;

use PDO;

class connection {

  public static function get() {
    if (!isset($GLOBALS['connection'])) {
      $GLOBALS['connection'] = new \PDO('mysql:host=localhost;dbname=webbomb', 'webbomb', 'webbomb');
    }
    return $GLOBALS['connection'];
  }
}