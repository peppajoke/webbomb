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
    foreach ($values as $name => $value) {
      if (property_exists($this, $name)) {
        $this->$name = $value;
      }
    }
  }

  public function __sleep() {
    return array_diff(array_keys(get_object_vars($this)), ['dao']);
  }

}