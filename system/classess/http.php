<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class cHttp {

    protected static $instance;
    public $contetType = 'text/html';
    public $charset = 'UTF-8';

    function __construct() {

    }


    public function sendHeader() {
      header('HTTP/1.0 200 OK');
      header('HTTP/1.1 200 OK');
      header('Status: 200 OK');
      header('Content-type: ' . $this->contentType . ';charset=' . $this->charset);
      header('X-Powered-By:' . $_SERVER['HTTP_HOST']);
    }

    public function redirect($url = '/', $code = 301) {
      header("location: {$url}", true, $code);
    }

    public function upload_img($preview = false) {
      
    }

    public function error404() {
      global $cTemplate;
      ob_end_clean();
      header('HTTP/1.0 404 Not Found');
      header('HTTP/1.1 404 Not Found');
      header('Status: 404 Not Found');
      $cTemplate->siteTitle('Страница не найдена')
                ->header()
                ->temp('404')
                ->footer()
                ->render();
      exit;
    }

    public static function getInstance() {
      if(isset(self::$instance) === false) { self::$instance = new self; }
      return self::$instance;
    }
  }
?>
