<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 8:14 PM
 */

namespace webBomb\interfaces;

interface i_entity_dao {
  public function loadById($id) : array;
  public function save(i_entity_model $model) : bool;
}