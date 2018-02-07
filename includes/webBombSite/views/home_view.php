<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 3:55 PM
 */

namespace webBombSite\views;

use webBomb\views\base\view;

class home_view extends view {

  protected function title(): string {
    return 'webBomb Home';
  }

  protected function body(): string {
    return '
        <div class="jumbotron bg-white">
          <h1 class="display-4">Welcome to webBomb</h1>
          <p class="lead">webBomb is an open source PHP/Javascript application engine for web developers who like to move fast.</p>
          <hr class="my-4">
          <p>webBomb works as a stand-alone MVC framework in PHP, with out of the box support for JSX, React/Redux, Bootstrap, Python, and MariaDB.</p>
          <p>With webBomb, you can quickly spin up a web server. Skip the boiler plate and start building your application.</p>
        </div>';
  }

  protected function javascriptDependencies(): array {
    return [];
  }

  public function customJavascript(): string {
    return '';
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
}