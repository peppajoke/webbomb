<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/3/2018
 * Time: 4:22 PM
 */

namespace webBomb\helpers;


use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class site_helper {

  public static function getConfigProperty(string $propertyName) {
    return $_REQUEST['CONFIG'][$propertyName];
  }

  public static function setConfig() {
    $configFiles = self::getFilesEndingWith('config.ini');
    if (count($configFiles) > 1) {
      throw new \Exception('Found more than one config.ini file! Your site should only have one!');
    } elseif (empty($configFiles)) {
      throw new \Exception('No config.ini file found!');
    }
    $_REQUEST['CONFIG'] = parse_ini_file(reset($configFiles));
  }

  public static function getFilesEndingWith(string $pattern) : array {
    $fileNames = [];
    $controllerIterator = new RecursiveDirectoryIterator('/var/www/includes/');
    foreach (new RecursiveIteratorIterator($controllerIterator) as $fileName => $file) {
      if (string_helper::stringEndsWith($fileName, $pattern)) {
        $fileNames[] = $fileName;
      }
    }
    return $fileNames;
  }

  public static function getIncludesPath() {
    $reflection = new \ReflectionClass(self::class);
    $namespace = string_helper::toForwardSlash($reflection->getNamespaceName());
    return str_replace($namespace, '',__DIR__);
  }

}