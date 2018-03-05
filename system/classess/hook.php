<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class cHook{

    protected static $instance;

    function __construct() {

    }

    public static function getInstance() {
      if(isset(self::$instance) === false) { self::$instance = new self; }
      return self::$instance;
    }
  }
?>
