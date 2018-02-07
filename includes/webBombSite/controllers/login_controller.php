<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 10:19 PM
 */

namespace webBombSite\controllers;

use webBomb\auth\authorizer;
use webBomb\auth\session;
use webBomb\controllers\base\controller;
use webBomb\views\auth\login_view;
use webBomb\views\base\view;

final class login_controller extends controller {

  private $authorizer;

  public function __construct() {
    $this->authorizer = new authorizer();
  }

  public function index(): view {
    return new login_view();
  }

  public function login($params) {
    $user = $this->authorizer->login($params['login'], $params['password']);
    if ($user->existsInDatabase()) {
      session::createSession($user);
      $this->forward();
    }
    return new login_view('Login failed. Please try again.');
  }

  public function logout() {
    session::kill();
    $this->forward('login');
  }

  public function show_index_link_in_layout(): bool {
    return false;
  }
}