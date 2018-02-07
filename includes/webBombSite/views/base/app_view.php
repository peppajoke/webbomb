<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 3:07 PM
 */

namespace webBombSite\views\base;

abstract class app_view extends view {
  const APP_MODEL_NAME = 'webBombAppModel';
  protected abstract function model();
  protected function customJavascript(): string {
    return self::APP_MODEL_NAME . ' = JSON.parse(' . serialize($this->model()) . ');';
  }
}