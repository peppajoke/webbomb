<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2018
 * Time: 7:14 PM
 */

namespace webWars\controllers;


use webBomb\auth\authorizer;
use webBomb\auth\user;
use webBomb\controllers\base\controller;
use webBomb\views\base\view;
use webBomb\views\auth\login_view;
use webBomb\views\auth\register_view;

class register_controller extends controller {

  private $authorizer;

  public function __construct() {
    $this->authorizer = new authorizer();
  }

  public function index($params = []): view {
    return new register_view();
  }

  public function register($params) {
    $email = $params['email'];
    $password = $params['password'];
    $username = $params['username'];
    $emailMatch = new user();
    $emailMatch->load(['email' => $email]);
    if ($emailMatch->existsInDatabase()) {
      return new register_view($email . ' is already associated with an account!');
    }
    $usernameMatch = new user();
    $usernameMatch->load(['username' => $username]);
    if ($usernameMatch->existsInDatabase()) {
      return new register_view($username . ' is already a registered user!');
    }
    // todo: check password complexity
    $newUser = $this->authorizer->register($username, $email, $password);
    // todo: add email confirmation
    if ($newUser->save()) {

      return new login_view(null, 'Account successfully registered!');
    }
    return new register_view('Something went wrong, please try again.');
  }

  public function showIndexLinkInLayout(): bool {
    return false;
  }
}