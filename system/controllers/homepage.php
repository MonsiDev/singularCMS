<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class my_homepage extends cController {

    function __construct($name) {
      parent::__construct();
      $this->model = $this->loadModel($name);
    }

    public function index($params) {
      $this->tmp->header()
                ->temp('homepage')
                ->footer()
                ->render();
    }
  }
?>
