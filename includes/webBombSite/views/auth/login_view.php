<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 10:21 PM
 */

namespace webBombSite\views\auth;

use webBomb\helpers\string_helper;
use webBombSite\views\base\view;

class login_view extends view {

  protected function title(): string {
    return 'Log In';
  }

  protected function body(): string {
    return '
      <div class="jumbotron bg-white">
          <form action="' . string_helper::getAppUrl('login', 'login') . '">
            <div class="form-group">
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="email address...">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="password" placeholder="password...">
            </div>
            <button type="submit" class="btn btn-secondary">Login</button>
            <button type="submit" class="btn btn-secondary">Register</button>
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