<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 8:50 PM
 */

namespace webBomb\interfaces;


interface i_entity_model extends i_model {
  public function getId();
  public function existsInDatabase() : bool;
  public function getNonIdColumnNames();
  public function getIdColumnName();
}