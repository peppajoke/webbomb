<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/4/2018
 * Time: 4:30 PM
 */

namespace webBomb\database\daos;

abstract class dao {

  protected $connection;

  public function __construct() {
    $this->connection = $this->getConnection();
  }

  protected function write($sql, $params) : bool {
    $pdo = $this->connection->prepare($sql);
    foreach ($params as $key => $value) {
      $pdo->bindValue(':' . $key, $value);
    }
    if (!$pdo->execute()) {
      echo 'SQL write error' . PHP_EOL;
      echo $sql . PHP_EOL;
      var_dump($pdo->errorInfo());
      return false;
    }
    return true;
  }

  protected function read($sql, $params) : array {
    $pdo = $this->connection->prepare($sql);
    foreach ($params as $key => $value) {
      $pdo->bindValue(':' . $key, $value);
    }
    if ($pdo->execute()) {
      return $pdo->fetchAll();
    }
    echo 'SQL read error' . PHP_EOL;
    echo $sql . PHP_EOL;
    var_dump($pdo->errorInfo());
    return [];
  }

  protected abstract function getConnection();
}