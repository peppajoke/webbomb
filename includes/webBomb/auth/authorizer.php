<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2018
 * Time: 5:30 PM
 */

namespace webBomb\auth;

class authorizer {

  public function login(string $login, string $password) : user {
    $user = new user();
    if (strpos($login, '@') === false) {
      $user->load(['username' => $login]);
    } else {
      $user->load(['email' => $login]);
    }
    if (!$user->existsInDatabase() || !password_verify($password, $user->password)) {
      return new user();
    }
    return $user;
  }

  public function register(string $username, string $email, string $password) : user {
    $user = new user();
    $user->username = $username;
    $user->email = $email;
    $user->password = password_hash($password, PASSWORD_DEFAULT);
    return $user;
  }

}