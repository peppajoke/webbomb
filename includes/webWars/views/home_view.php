<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 3:55 PM
 */

namespace webWars\views;

use webBomb\helpers\string_helper;
use webBomb\views\base\view;
use webWars\models\permission;

class home_view extends view {

  public function __construct($user) {
    parent::__construct();
    $this->user = $user;
  }

  protected function title(): string {
    return 'Web Wars';
  }

  protected function body(): string {
    return '
        <div class="jumbotron bg-white">
          <h1 class="display-4">Welcome to Web Wars!</h1>
          <hr class="my-4">
          ' . $this->suggestedAction() . '
        </div>';
  }

  private function suggestedAction() {
    $output = '<div>';
    if (!$this->user) {
      $output .= 'webWars is currently in closed alpha testing. <a class="font-weight-bold" href="' . string_helper::getAppUrl('register') . '">Click here to apply for an account</a>';
    } elseif (!$this->user->hasPermission(permission::PERMISSION_ID_VERIFIED_PLAYER)) {
      $output .= 'You are not a verified player. Please reach out to Jack if you\'d like to play during alpha testing.';
    } elseif (!$this->user->getHeroUnit()) {
      $output .= 'Looks like you don\'t have an active Hero. Let\'s get you started with a <a class="font-weight-bold" href="' . string_helper::getAppUrl('new_hero') . '">new Hero!</a>';
    } else {
      $output .= 'What are you waiting for? Go blow some shit up!';
    }
    $output .= '</div>';
    return $output;
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