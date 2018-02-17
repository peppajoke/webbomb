<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2018
 * Time: 7:06 PM
 */

namespace webBomb\views\auth;

use webBomb\helpers\string_helper;
use webBomb\views\base\view;
use webWars\views\layout_view;

class register_view extends view {

  private $errorMessage;

  public function __construct($errorMessage = null) {
    parent::__construct();
    $this->errorMessage = $errorMessage;
  }

  protected function title(): string {
    return 'Register';
  }

  protected function body(): string {
    return '
    <div class="jumbotron bg-white">
    ' . ($this->errorMessage ? '
      <div class="alert alert-danger" role="alert">
        ' . $this->errorMessage . '
      </div>
      ' : '') . '
        <form autocomplete="off" action="' . string_helper::getAppUrl('register', 'register') . '" method="post">
          <div class="form-group">
            <input pattern=".{4,}" autocomplete="off" required title="4 characters minimum" type="text" class="form-control" id="username" name="username" placeholder="username">
          </div>
          <div class="form-group">
            <input pattern=".{4,}" autocomplete="off" required title="4 characters minimum" type="email" class="form-control" id="email" name="email" placeholder="email address">
          </div>
          <div class="form-group">
            <input pattern=".{8,}" autocomplete="off" required title="8 characters minimum" type="password" class="form-control" id="password" name="password" placeholder="password">
          </div>
          <button class="btn btn-secondary" type="submit" >Register</button>
        </form>
    </div>
    ';
  }

  protected function javascriptDependencies(): array {
    return [];
  }

  protected function cssDependencies(): array {
    return [];
  }

  protected function layoutView() {
    return new layout_view();
  }

  protected function customJavascript(): string {
    return '';
  }
}