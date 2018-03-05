<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class my_homepage extends cController {

    function __construct() {

    }

    public function index($params) {
      global $cTemplate;
      $cTemplate->assign('d', '')
                ->header()
                ->temp('homepage')
                ->footer()
                ->render();
    }
  }
?>
