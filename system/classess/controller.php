<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class cController {

    protected static $instance;
    public $tmp;

    function __construct() {
      global $cTemplate;
      $this->tmp = $cTemplate;
    }

    public function loadModel($name) {
      $path = BASEPATH . '/system/models/' . $name . '.php';
      if(file_exists($path)) {
        require_once($path);
        $class = $name . '_model';
        if(class_exists($class)) {
          return new $class;
        }
        return false;
      }
    }

    public static function getInstance() {
      if(isset(self::$instance) === false) { self::$instance = new self; }
      return self::$instance;
    }

  }
?>
