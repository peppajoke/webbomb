<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 7:53 PM
 */

namespace webBomb\interfaces;

interface i_model {
  public function load($params);
  public function save();
}