<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 1:30 PM
 */

namespace webBomb\views\base;

abstract class react_view extends app_view {
  protected abstract function react_component_name() : string;
  protected function javascriptDependencies(): array {
    return [
      'https://unpkg.com/react@16/umd/react.production.min.js',
      'https://unpkg.com/react-dom@16/umd/react-dom.production.min.js',
      $this->react_component_name()
    ];
  }

  protected function body() : string {
    return '<div id="root"></div>';
  }

  protected function customJavascript(): string {
    return parent::customJavascript() . 'ReactDOM.render(
      React.createElement(
        App,
        ' . app_view::APP_MODEL_NAME . ',
        null
      ),
      document.getElementById(\'root\')
      )
    );';
  }
}