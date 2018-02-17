<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 9:37 PM
 */

namespace webBomb\models;


use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;
use webBomb\database\daos\auto_sql_entity_dao;
use webBomb\interfaces\i_entity_model;

class entity_model extends model implements i_entity_model {

  public $id;

  public function __construct() {
    $this->dao = new auto_sql_entity_dao((new ReflectionClass($this))->getShortName());
  }

  public function load($params) {
    $this->populate($this->dao->load($params));
  }

  public function getSet($params) {
    return $this->createArray($this->dao->loadSet($params));
  }

  protected function createArray($results) {
    $set = [];
    foreach ($results as $result) {
      $className = get_class($this);
      $model = new $className;
      $model->populate($result);
      $set[] = $model;
    }
    return $set;
  }

  public function save($columns = []) : bool {
    return $this->dao->save($this, $columns);
  }

  public function delete($params) : bool {
    return $this->dao->delete($params);
  }

  public function getId() {
    return $this->id;
  }

  public function existsInDatabase(): bool {
    return !empty($this->id);
  }

  public function getNonIdColumnNames() {
    return array_diff($this->getAllPublicProperties(), [ $this->getIdColumnName() ]);
  }

  protected function getAllPublicProperties() {
    return array_map(
      function ($prop) {
        return $prop->getName();
      },
      (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC)
    );
  }

  public function getIdColumnName() {
    return 'id';
  }
}