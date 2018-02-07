<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 7:58 PM
 */

namespace webBomb\auth;

use webBomb\models\entity_model;

class user extends entity_model {
  public $username;
  public $password;
  public $email;
}
