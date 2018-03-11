<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class cTemplate {

    protected static $instance;
    private $vars = [];
    private $temps = [];
    public $site_title = '';
    public $site_keywords = [];
    public $site_description = '';

    function __construct() {
      $this->site_keywords = getConfig('site')['keywords'];
      $this->site_description = getConfig('site')['description'];
    }

    public function assign($key, $val = false) {
      if(is_array($key) == true) {
        foreach($key as $k => $v) {
          if(is_array($v)) {
            $this->vars[$k] = (object)$v;
          } else {
            $this->vars[$k] = $v;
          }
        }
        return $this;
      }
      $this->vars[$key] = $val;
      return $this;
    }

    public function header($root = '') {
      $path = trim($root . '/assets/header', '/');
      return $this->temp($path);
    }

    public function footer($root = '') {
      $path = trim($root . '/assets/footer', '/');
      return $this->temp($path);
    }

    public function render_temp($name, $vars = []) {
      $path = BASEPATH . '/system/template/' . $name . '.php';
      if(file_exists($path) == true) {
        extract($vars);
        require_once($path);
        return true;
      }
      echo('File such not found ' . $path);
    }

    public function temp($name) {
      $path = BASEPATH . '/system/template/' . $name . '.php';
      if(file_exists($path) == true) {
        $this->temps[] = $path;
        return $this;
      }
      echo('File such not found ' . $path);
    }

    public function siteTitle($title) {
      $this->site_title = $title;
      return $this;
    }

    public function loadMenu($name) {
      global $cDBase;
      $cDBase->query('SELECT * FROM `cms_menu` WHERE `menu_name` = :name', ['name' => $name]);
      return $cDBase->fetch();
    }

    public static function getInstance() {
      if(isset(self::$instance) === false) { self::$instance = new self; }
      return self::$instance;
    }

    public function render() {
      extract($this->vars);
      foreach($this->temps as $temp) {
        require_once($temp);
      }
    }
  }
?>
