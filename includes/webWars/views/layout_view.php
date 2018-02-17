<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 6:54 PM
 */

namespace webWars\views;

use webBomb\auth\session;
use webBomb\factories\controller_factory;
use webBomb\helpers\site_helper;
use webBomb\helpers\string_helper;
use webBomb\views\base\view;

final class layout_view extends view {

  public $mainView;

  public function render() : string {
    return '
            <!doctype html>
            <html lang="en">
              <head>
              ' . $this->generateJsTags() . '
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, user-scalable=no">
                <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
                <title>' . $this->title() . '</title>
              </head>
              <body>
                <div class="container-fluid" style="padding:0">' . $this->body() . $this->customJavascript() . $this->generateCssTags() . '
                </div>
              </body>
            </html>
            ';
  }

  protected function javascriptDependencies(): array {
    return array_merge(
      [
        'https://code.jquery.com/jquery-3.2.1.slim.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
        'https://use.fontawesome.com/854c747273.js'
      ],
      $this->mainView->javascriptDependencies()
    );
  }

  protected function cssDependencies(): array {
    return array_merge(
      [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
      ],
      $this->mainView->cssDependencies()
    );
  }

  protected function title(): string {
    return $this->mainView->title();
  }

  protected function body(): string {
    return $this->navigationMenu() . '<div class="container">' . $this->mainView->body() . '</div>';
  }

  public function customJavascript(): string {
    return '' . $this->mainView->renderCustomJavascript();
  }

  private function navigationMenu() {
    $currentApp = $_GET['app'] ?? 'home';
    $allControllerNames = controller_factory::getAllLayoutControllers();

    $output = '<div class="navbar navbar-dark bg-dark box-shadow">
    <div class="navbar-inner w-100">
<a class="navbar-brand ' . ( $currentApp === 'home' ? '' : 'text-muted') . '" href="' . string_helper::getAppUrl() . '">' . $this->logo() . site_helper::getConfigProperty('appNamespace') . '</a>
<ul class="nav d-inline-block">
';
    foreach ($allControllerNames as $controllerName) {
      $app = string_helper::controllerToAppName($controllerName);
      $isCurrentApp = $currentApp === $app;
      $output .= '
      <li class="nav-item d-inline-block">
          <a href="' . string_helper::getAppUrl($app) . '" class="navbar-brand ' . ($isCurrentApp ? '' : 'text-muted') . '">
            ' . $app . '
            
          </a>
      </li>';
    }

    $output .= '</ul><span class="float-right">' . $this->accountManagement() . '<ul class="nav d-inline-block">';

    foreach ($this->externalLinks() as $externalLink) {
      $output .= '<li class="nav-item d-inline-block">' . $externalLink . '</li>';
    }
    $output .= '
      </ul></span></div></div>';
    return $output;
  }

  private function logo() {
    return '<i class="fa fa-bomb" aria-hidden="true"></i>';
  }

  protected function externalLinks() : array {
    return [
      //'<a class="navbar-brand" target="_blank" href="https://github.com/peppajoke/webbomb"><i class="fa fa-github" style="margin-right:10px" aria-hidden="true"></i>github</a>'
    ];
  }

  protected function layoutView() {
    return null;
  }

  private function accountManagement() {
    $user = session::getUser();
    if ($user) {
      return '
        <a class="text-white">Logged in as ' . $user->username .'</a>
        <a href="' . string_helper::getAppUrl('login', 'logout') . '" class="text-white">[logout]</a>
        <div>
          <label class="text-white">Cash: $' . $user->getCash() . '</label>
          <label class="text-white">XP: ' . $user->getXp() . '</label>
        </div>
      ';
    }
    return '
    <a href="' . string_helper::getAppUrl('login') . '" class="text-muted">[login]</a>
    <a href="' . string_helper::getAppUrl('register') . '" class="text-muted mr-2">[register]</a>';
  }
}