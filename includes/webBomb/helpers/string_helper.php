<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 10:15 PM
 */

namespace webBomb\helpers;

class string_helper {
  public static function stringEndsWith(string $string, string $endingString) : bool {
    $length = strlen($endingString);
    return $length === 0 || (substr($string, - $length) === $endingString);
  }

  public static function controllerToAppName(string $controllerName) : string {
    $appName = str_replace('_controller.php', '', $controllerName);
    $appName = str_replace('/', '', strrchr($appName, '/'));
    return $appName;
  }
  
  public static function controllerFileToClassName(string $controllerFilePath) {
    $className = str_replace(site_helper::getIncludesPath(), '', $controllerFilePath);
    $className = str_replace('.php', '', $className);
    return self::toBlackSlash($className);
  }

  public static function toBlackSlash(string $string) : string {
   return str_replace('/','\\', $string);
  }

  public static function toForwardSlash(string $string) : string {
    return str_replace('\\','/', $string);
  }
}