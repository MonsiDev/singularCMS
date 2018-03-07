<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class my_home extends cController{

    function __construct($name) {
      parent::__construct();
    }

    public function index($params) {
      $this->tmp->siteTitle('Панель управления')
                 ->header()
                 ->temp('home/index')
                 ->footer()
                 ->render();
    }
  }
?>
