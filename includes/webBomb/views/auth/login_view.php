<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 10:21 PM
 */

namespace webBomb\views\auth;

use webBomb\helpers\string_helper;
use webBomb\views\base\view;
use webWars\views\layout_view;

class login_view extends view {

  private $errorMessage;
  private $successMessage;

  public function __construct($errorMessage = null, $successMessage = null) {
    parent::__construct();
    $this->errorMessage = $errorMessage;
    $this->successMessage =  $successMessage;
  }

  protected function title(): string {
    return 'Log In';
  }

  protected function body(): string {
    return '
      <div class="jumbotron bg-white">
      ' . ($this->errorMessage ? '
      <div class="alert alert-danger" role="alert">
        ' . $this->errorMessage . '
      </div>
      ' : '') . ($this->successMessage ? '
      <div class="alert alert-success" role="alert">
        ' . $this->successMessage . '
      </div>
      ' : '') . '
          <form action="' . string_helper::getAppUrl('login', 'login') . '" method="post">
            <div class="form-group">
              <input pattern=".{4,}" required title="4 characters minimum" type="text" class="form-control" id="login" name="login" placeholder="username or email address">
            </div>
            <div class="form-group">
              <input pattern=".{8,}" required title="8 characters minimum" type="password" class="form-control" id="password" name="password" placeholder="password">
            </div>
            <button type="submit" class="btn btn-secondary">Login</button>
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

  protected function externalLinks(): array {
    return [];
  }

  protected function customJavascript(): string {
    return '';
  }
}