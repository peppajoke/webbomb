<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/3/2018
 * Time: 3:37 PM
 */

namespace webBomb\interfaces;

interface i_controller {
  public function performAction(string $actionName, array $params);
}