<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 8:12 PM
 */

namespace webBomb\database\daos;

use webBomb\database\connection;
use webBomb\interfaces\i_entity_dao;
use webBomb\interfaces\i_entity_model;

class auto_sql_entity_dao extends dao implements i_entity_dao {

  protected $tableName;

  public function __construct($tableName) {
    parent::__construct();
    $this->tableName = $tableName;
  }

  protected function getConnection() {
    return connection::get();
  }

  public function loadById($id): array {
    return $this->load(['id' => $id]);
  }

  public function load(array $params): array {
    $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ';
    $counter = 0;
    foreach ($params as $name => $value) {
      if ($counter > 0) {
        $sql .= ' AND ';
      }
      $sql .= $name . ' = :' . $name;
      $params[$name] = $value;
      $counter++;
    }
    $sql .= ' LIMIT 1;';
    $results = $this->read($sql , $params);
    if (empty($results)) {
      return [];
    }
    return $results[0];
  }

  public function loadSet(array $params) {
    $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ';
    $counter = 0;
    foreach ($params as $name => $value) {
      if ($counter > 0) {
        $sql .= ' AND ';
      }
      $sql .= $name . ' = :' . $name;
      $params[$name] = $value;
    }
    $results = $this->read($sql , $params);
    if (empty($results)) {
      return [];
    }
    return $results;
  }

  public function save(i_entity_model $model, $columnsToSave = []): bool {
    if ($model->existsInDatabase()) {
      return $this->update($model, $columnsToSave);
    }
    return $this->insert($model);
  }

  protected function insert(i_entity_model $model) : bool {
    $sql = 'INSERT INTO ' . $this->tableName . '(';
    $count = 0;
    $params = [];
    $valueSQL = '';
    foreach ($model->getNonIdColumnNames() as $columnName) {
      if ($count > 0) {
        $sql .= ',';
        $valueSQL .= ',';
      }
      $sql .= $columnName;
      $params[$columnName] = $model->$columnName;
      $valueSQL .= ':' . $columnName;
      $count++;
    }
    $sql .= ') VALUES (' . $valueSQL . ')';

    if ($count === 0) {
      return false;
    }
    return $this->write($sql . ';', $params);
  }


  protected function update(i_entity_model $model, $columnsToSave = []) : bool {
    $sql = 'UPDATE ' . $this->tableName . ' SET ';
    $count = 0;
    $params = [];

    $columnsToSave = empty($columnsToSave) ? $model->getNonIdColumnNames() : $columnsToSave;

    foreach ($columnsToSave as $columnName) {
      if ($count > 0) {
        $sql .= ',';
      }
      $sql .= $columnName . ' = :' . $columnName;
      $params[$columnName] = $model->$columnName;
      $count++;
    }
    $sql .= ' WHERE ' . $model->getIdColumnName() . ' = :' . $model->getIdColumnName();
    $params[$model->getIdColumnName()] = $model->getId();
    if ($count === 0) {
      return false;
    }
    return $this->write($sql, $params);
  }

  public function delete(array $args) : bool {
    $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ';
    $count = 0;
    $params = [];
    foreach ($args as $columnName => $value) {
      if ($count > 0) {
        $sql .= ' AND ';
      }
      $sql .= $columnName . ' = :' . $columnName;
      $params[$columnName] = $value;
      $count++;
    }

    if ($count === 0) {
      return false;
    }
    return $this->write($sql, $params);
  }

}