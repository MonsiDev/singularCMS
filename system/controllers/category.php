<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class my_category extends cController {

    function __construct($name) {
      parent::__construct();
      $this->model = $this->loadModel($name);
    }

    public function index($params) {
      $objects = $this->model->getObjects();
      if($objects === false) {
        $this->model
            ->http
            ->error404();
      }
      $this->tmp->siteTitle($this->model->title)
                ->assign('MODEL_TITLE', $this->model->title)
                ->assign('objects', $objects)
                ->header()
                ->temp('category')
                ->footer()
                ->render();
    }
  }
?>
