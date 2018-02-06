<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/4/2018
 * Time: 4:06 PM
 */

namespace webBomb\database;

class connection {
  public static function get(string $sqlString) {
    $pdo = new \PDO('mysql:host=localhost;dbname=webbomb', 'webbomb', 'webbomb');
    return $pdo->prepare($sqlString);
  }
}