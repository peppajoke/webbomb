<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../includes/autoloader.php');

\webBomb\helpers\site_helper::setConfig();

const APP = 'app';
const ACTION = 'action';

$appName = '';
$actionName = '';
if (!isset($_REQUEST[APP])) {
  $_REQUEST[APP] = 'home';
}

if (!isset($_GET[ACTION])) {
  $_REQUEST[ACTION] = 'index';
}

$controller = \webBomb\factories\controller_factory::getController($_REQUEST[APP]);

$response = $controller->performAction($_REQUEST[ACTION], $_REQUEST);

if ($response instanceof \webBomb\interfaces\i_view) {
  echo $response->render();
} else {
  echo $response;
}

?>
