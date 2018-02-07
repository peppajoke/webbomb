<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/7/2018
 * Time: 9:54 AM
 */

namespace webBomb\auth;


use webBomb\models\entity_model;

class user_session extends entity_model {
  public $token;
  public $userId;
  public $expires;
}