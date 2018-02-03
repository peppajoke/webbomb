<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../includes/autoloader.php');

\webBomb\helpers\site_helper::setConfig();

const APP = 'app';
const ACTION = 'action';

$appName = '';
$actionName = '';
if (!isset($_GET[APP])) {
  $_GET[APP] = 'home';
}

if (!isset($_GET[ACTION])) {
  $_GET[ACTION] = 'index';
}

$controller = \webBomb\factories\controller_factory::getController($_GET[APP]);

$response = $controller->performAction($_GET[ACTION], $_GET);

if ($response instanceof \webBomb\interfaces\i_view) {
  echo $response->render();
} else {
  echo $response;
}

?>
