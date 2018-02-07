<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 1:16 AM
 */

namespace webBombSite\controllers\base;

use webBomb\interfaces\i_controller;
use webBombSite\views\base\view;

abstract class controller implements i_controller {

  public abstract function index() : view;

  protected function preAction($params) {

  }

  protected function postAction($params) {

  }

  protected function userHasAccess() {
    return true;
  }

  public function performAction(string $actionName, array $params) {
    if (!$this->userHasAccess()) {
      return; // todo: add login redirect
    }
    $this->preAction($params);
    $output = $this->$actionName($params);
    $this->postAction($params);
    return $output;
  }
}