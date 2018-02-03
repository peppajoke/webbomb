<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 1:25 AM
 */

namespace webBomb\factories;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use webBomb\helpers\site_helper;
use webBomb\helpers\string_helper;
use webBomb\interfaces\i_controller;

class controller_factory {
  public static function getController($appName) : i_controller {
    $controllerName = site_helper::getConfigProperty('appNamespace') . '\\controllers\\' . $appName . '_controller';
    return new $controllerName;
  }

  public static function getAllControllers() : array {
    $controllerNames = [];
    $path = site_helper::getIncludesPath() . site_helper::getConfigProperty('appNamespace') . '/controllers/';
    $absolutePath = realpath($path);
    $controllerIterator = new RecursiveDirectoryIterator($absolutePath);
    foreach (new RecursiveIteratorIterator($controllerIterator) as $fileName => $file) {
      if (string_helper::stringEndsWith($fileName, '_controller.php')) {
        $className = string_helper::controllerFileToClassName($fileName);
        $reflection = new \ReflectionClass($className);
        if (!$reflection->isAbstract()) {
          $controllerNames[] = $fileName;
        }
      }
    }
    return $controllerNames;
  }
}