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

  public abstract function index($params = []) : view;
  public abstract function showIndexLinkInLayout() : bool;

  protected function preAction($params) {

  }

  protected function postAction($params) {

  }

  public function forward(string $appName = 'home', string $actionName = 'index', array $params = []) {
    header('Location: ' . string_helper::getAppUrl($appName, $actionName, $params));
  }

  public function performAction(string $actionName, array $params = []) {
    $this->preAction($params);
    $output = $this->$actionName($params);
    $this->postAction($params);
    return $output;
  }
}