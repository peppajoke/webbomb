<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/7/2018
 * Time: 3:28 PM
 */

namespace webBomb\models;

class permission extends entity_model {
  const PERMISSION_ID_VERIFIED_PLAYER = 1;
  const PERMISSION_ID_VETERAN_PLAYER = 2;
  const PERMISSION_ID_MODERATOR = 3;
  const PERMISSION_ID_STAFF = 4;
  const PERMISSION_ID_GOD = 5;

  public $name;
}