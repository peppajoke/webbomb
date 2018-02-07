<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 1:16 AM
 */

namespace webBomb\controllers\base;

use webBomb\helpers\string_helper;
use webBomb\interfaces\i_controller;
use webBomb\views\base\view;

abstract class controller implements i_controller {

  public abstract function index() : view;
  public abstract function show_index_link_in_layout() : bool;

  protected function preAction($params) {

  }

  protected function postAction($params) {

  }

  protected function userHasAccess() {
    return true;
  }

  public function forward(string $appName = 'home', string $actionName = 'index', array $params = []) {
    header('Location: ' . string_helper::getAppUrl($appName, $actionName, $params));
  }

  public function performAction(string $actionName, array $params = []) {
    if (!$this->userHasAccess()) {
      return; // todo: add login redirect
    }
    $this->preAction($params);
    $output = $this->$actionName($params);
    $this->postAction($params);
    return $output;
  }
}