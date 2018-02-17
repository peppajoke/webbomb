<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2018
 * Time: 8:58 PM
 */

namespace webBomb\auth;

use webWars\models\lock_on;
use webWars\models\unit;
use webWars\models\user_permission;
use webWars\models\user_resources;

class session {

  public static function createSession(user $user) {
    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
    ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 7);
    ini_set('session.save_path', '/var/sessions');
    $userSession = new user_session();
    $userSession->userId = $user->id;
    $now = date('Y-m-d H:i:s');
    $userSession->expires = date('Y-m-d H:i:s', strtotime($now . ' + 7 days'));
    $userSession->token = self::generateToken(200);
    $userSession->save();
    setcookie('user_token', $userSession->token);
  }

  public static function mountUserSession() {
    $userToken = self::getUserToken();
    if (!empty($userToken) && strlen($userToken) === 200) {
      $userSession = new user_session();
      $userSession->load(['token' => $userToken]);
      $user = new user();
      $user->load(['id' => $userSession->userId]);
      if ($user->existsInDatabase()) {
        $userPermissions = new user_permission();
        $permissions = $userPermissions->getSet(['userId' => $user->id]);
        $userResources = new user_resources();
        $userResources->load(['userId' => $user->id]);
        $heroUnit = new unit();
        $heroUnit->load([ 'ownerId' => $user->id, 'hero' => 1 ]);
        if (!$heroUnit->existsInDatabase()) {
          $heroUnit = null;
        }

        $user->setHeroUnit($heroUnit);
        $user->setPermissions($permissions);
        $user->setResources($userResources);
        $GLOBALS['user'] = $user;
      }
    }
  }

  public static function getUserToken() {
    return $_COOKIE['user_token'] ?? null;
  }

  private static function generateToken($length = 200) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public static function getUser() {
    return $GLOBALS['user'] ?? null;
  }

  public static function kill() {
    $token = self::getUserToken();
    if ($token) {
      $userSession = new user_session();
      $userSession->delete(['token' => $token]);
    }
  }
}