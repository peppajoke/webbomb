<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 1:30 PM
 */

namespace webBomb\views\base;

use webBomb\interfaces\i_view;

abstract class view implements i_view {

  protected $layoutView = null;

  public function __construct() {
    $layoutView = $this->layoutView();
    if ($layoutView) {
      $layoutView->mainView = $this;
      $this->layoutView = $layoutView;
    }
  }

  public function render() : string {
    if ($this->layoutView) {
      return $this->layoutView->render();
    }
    return $this->renderPage();
  }
  protected abstract function title() : string;
  protected abstract function body() : string;
  protected abstract function javascriptDependencies() : array;
  protected abstract function cssDependencies() : array;
  protected abstract function layoutView();

  protected abstract function customJavascript() : string;

  protected function renderCustomJavascript() {
    $customJavascript = $this->customJavascript();
    return !empty($customJavascript) ? '<script>' . $customJavascript . '</script>' : '';
  }

  protected function generateJsTags() : string {
    $output = '';
    foreach ($this->javascriptDependencies() as $js) {
      $output .= '<script src="' . $js . '"></script>';
    }
    return $output;
  }

  protected function generateCssTags() {
    $output = '';
    foreach ($this->cssDependencies() as $css) {
      $output .= ' <link rel="stylesheet" href="' . $css . '">';
    }
    return $output;
  }

  protected function renderPage() {
    return '
            <!doctype html>
            <html lang="en">
              <head>
              ' . $this->generateJsTags() . '
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, user-scalable=no">
                <link rel="shortcut icon" href="./src/favicon.ico">
                <title>' . $this->title() . '</title>
              </head>
              <body>
                ' . $this->body() . $this->renderCustomJavascript() . $this->generateCssTags() . '
              </body> 
            </html>
            ';
  }
}