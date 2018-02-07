<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 12:45 PM
 */

namespace webBomb\controllers\base;

abstract class auth_controller extends controller {

  protected $user;

  /**
   * @return string[] of permissions to enforce on the controller level, empty array if you just want them to have a login
   */
  public abstract function getRequiredPermissions() : array;

  protected function user_has_access() {
    return parent::user_has_access(); // todo, add user validation and specific permissions checking
  }
}