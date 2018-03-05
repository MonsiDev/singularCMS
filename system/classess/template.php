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
        $this->vars[] = $key;
        return $this;
      }
      $this->vars[$key] = $val;
      return $this;
    }

    public function header() {
      return $this->temp('assets/header');
    }

    public function footer() {
      return $this->temp('assets/footer');
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
