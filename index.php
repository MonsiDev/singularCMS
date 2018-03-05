<?php
  ob_start();
  session_start();
  define('BASEPATH', dirname(__FILE__));

  $bootstrap = require_once(BASEPATH . '/system/bootstrap.php');
  require_once(BASEPATH . '/system/config.php');

  foreach($bootstrap as $class) {
    $boot_path = BASEPATH . '/system/' . $class . '.php';
    if(file_exists($boot_path) === false) {
      exit('NO SUCH FILE ' . $boot_path);
    }
    require_once($boot_path);
  }

  global $cTemplate;
  global $cUser;
  global $cDBase;
  global $cHook;
  global $cHttp;

  $cHook = cHook::getInstance();
  $cDBase = cDBase::getInstance();
  $cUser = cUser::getInstance();
  $cRoute = cRoute::getInstance();
  $cHttp = cHttp::getInstance();
  $cTemplate = cTemplate::getInstance();

  $cRoute->rules = require_once(BASEPATH . '/system/route_rules.php');
  $cHttp->sendHeader();
  $cRoute->run();

  ob_end_flush();
