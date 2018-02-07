<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/29/2018
 * Time: 7:59 PM
 */

namespace webBombSite\views;

use webBomb\views\base\view;

class examples_view extends view {

  protected function title(): string {
    return 'webBomb Examples';
  }

  protected function body(): string {
    return 'EXAMPLES HURR';
  }

  protected function javascriptDependencies(): array {
    return [];
  }

  protected function cssDependencies(): array {
    return [];
  }

  public function customJavascript(): string {
    return '';
  }

  protected function layoutView() {
    return new layout_view();
  }

  protected function externalLinks(): array {
    return [];
  }
}