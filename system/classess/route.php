<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class cRoute {

    protected static $instance;
    private $uri;
    public $rules;
    public $page = "404";

    function __construct() {
      $this->uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), "/");
    }

    public function add($reg, $controller = 'homepage', $action = 'index') {
      $this->rules[$reg] = [
        'controller' => $controller,
        'action' => $action
      ];
    }

    public function getUri() {
      return $this->uri;
    }

    public function run() {
      global $cHttp;
      if(is_array($this->rules)) {
        foreach($this->rules as $rules => $event) {
          if(preg_match($rules, $this->uri)) {
            $path = BASEPATH . '/system/controllers/' . $event['controller'] . '.php';
            if(file_exists($path)) {
              require_once($path);
              $class_name = 'my_' . mb_strtolower($event['controller']);
              if(class_exists($class_name)) {
                $class = new $class_name($event['controller']);
                $params = explode('/', $this->uri);
                $class->{$event['action']}($params);
              }
              $this->page = $event['controller'];
              return true;
            }
          }
        }
      }
      $cHttp->error404();
    }

    public static function getInstance() {
      if(isset(self::$instance) === false) { self::$instance = new self; }
      return self::$instance;
    }
  }
?>
