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
    return $pdo->execute();
  }

  protected function read($sql, $params) : array {
    $pdo = $this->connection->prepare($sql);
    foreach ($params as $key => $value) {
      $pdo->bindValue(':' . $key, $value);
    }
    if ($pdo->execute()) {
      return $pdo->fetchAll();
    }
    return [];
  }

  protected abstract function getConnection();
}