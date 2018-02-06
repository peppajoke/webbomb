<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 8:05 PM
 */

namespace webBomb\models;

use webBomb\interfaces\i_model;

abstract class model implements i_model {
  protected $dao;

  public function populate(array $values) {
    if (empty($values)) {
      throw new \Exception('ERROR: Tried to populate a model with an empty values array.');
    }
    foreach ($values as $name => $value) {
      if (property_exists($this, $name)) {
        $this->$name = $value;
      }
    }
  }
}