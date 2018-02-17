<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 12:45 PM
 */

namespace webBomb\controllers\base;

use webBomb\auth\session;

abstract class auth_controller extends controller {

  protected $user;

  public function __construct() {
    $this->user = session::getUser();
  }

  public function performAction(string $actionName, array $params = []) {
    if (!$this->user) {
      $this->forward('login');
      return;
    }

    if (!$this->hasRequiredPermissions()) {
      $this->forward();
      return;
    }

    return parent::performAction($actionName, $params);
  }

  public function hasRequiredPermissions() {
    $requiredPermissionIds = $this->getRequiredPermissionIds();

    foreach ($requiredPermissionIds as $requiredPermissionId) {

      if (!$this->user->hasPermission($requiredPermissionId)) {
        return false;
      }
    }
    return true;
  }

  /**
   * @return int[] of permissions to enforce on the controller level, empty array if you just want them to have a login
   */
  public abstract function getRequiredPermissionIds() : array;

}