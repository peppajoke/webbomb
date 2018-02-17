<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/5/2018
 * Time: 7:58 PM
 */

namespace webBomb\auth;

use webBomb\models\entity_model;
use webWars\models\permission;
use webWars\models\unit;
use webWars\models\user_permission;
use webWars\models\user_resources;

class user extends entity_model {
  public $username;
  public $password;
  public $email;

  protected $permissions = [];
  protected $resources;
  protected $heroUnit;

  public function hasPermission(int $permissionId) {
    foreach ($this->permissions as $permission) {
      // ints are coming back from PDO as strings currently...it would be nice if we could fix that
      if ($permission->permissionId == $permissionId) {
        return true;
      }
    }
    return false;
  }

  public function getCash() {
    return $this->resources->cash;
  }

  public function getXp() {
    return $this->resources->xp;
  }

  public function setPermissions($permissions) {
    $this->permissions = $permissions;
  }

  public function setHeroUnit($heroUnit) {
    $this->heroUnit = $heroUnit;
  }

  public function getHeroUnit() {
    return $this->heroUnit;
  }

  public function setResources($resources) {
    $this->resources = $resources;
  }

  public function initializeUser() {
    if (!$this->existsInDatabase()) {
      return;
    }
    $userResources = new user_resources();
    $userResources->xp = 0;
    $userResources->cash = 0;
    $userResources->userId = $this->id;
    $userResources->save();
    $this->spawnHeroUnit();
    $this->grantPermission(permission::PERMISSION_ID_VERIFIED_PLAYER);
    // put a wall behind this before release
  }

  public function grantPermission(int $permissionId) {
    if ($permissionId === permission::PERMISSION_ID_GOD || $permissionId === permission::PERMISSION_ID_STAFF) {
      return;
    }
    $userPermission = new user_permission();
    $userPermission->userId = $this->id;
    $userPermission->permissionId = $permissionId;
    $userPermission->save();
  }

  public function canBuildUnits() {
    return true; // todo: make this something else
  }

  public function spawnHeroUnit() {
    $unit = new unit();
    $unit->name = $this->username;
    $unit->maxHp = 1000;
    $unit->maxAp = 1000;
    $unit->airbourne = false;
    $unit->movementSpeed = 20;
    $unit->x = 0;
    $unit->y = 0;
    $unit->defense = 100;
    $unit->offense = 100;
    $unit->ownerId = $this->id;
    $unit->hero = true;
    $unit->initializeUnit();
    $unit->save();
  }
}
