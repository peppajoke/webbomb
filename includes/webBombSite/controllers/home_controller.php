<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/28/2018
 * Time: 12:41 PM
 */

namespace webBombSite\controllers;

use webBomb\controllers\base\controller;
use webBomb\views\base\view;
use webBombSite\views\home_view;

class home_controller extends controller {

  public function index() : view {
    return new home_view();
  }

  public function show_index_link_in_layout(): bool {
    return false;
  }
}