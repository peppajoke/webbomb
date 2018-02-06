<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 9:37 PM
 */

namespace webBomb\models;


use ReflectionObject;
use ReflectionProperty;
use webBomb\database\daos\auto_sql_entity_dao;
use webBomb\interfaces\i_entity_model;

class entity_model extends model implements i_entity_model {

  public $id;

  public function __construct() {
    $this->dao = new auto_sql_entity_dao();
  }

  public function load() {
    $this->dao->loadById($this->id);
  }

  public function save() {
    $this->dao->save($this);
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
    return (new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC);
  }

  public function getIdColumnName() {
    return 'id';
  }
}