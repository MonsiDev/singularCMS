<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class my_object extends cController{

    public $model;

    public $category_id = 0;
    public $category_title = '';
    public $category_name = '';

    public $type_id = 0;
    public $type_name = '';
    public $type_title = '';

    function __construct($name) {
      parent::__construct();
      $this->model = $this->loadModel($name);
    }
    public function index($params) {
      $object = $this->model->getObject($params);
      if($object === false) {
        $this->model
            ->http->error404();
      }
      if(isAjax() === true) {
        jsonSend($object);
      }
      $this->title = $object->title;
      $this->tmp->siteTitle($object->object_title)
                ->assign('permalink', $this->model->permalink)
                ->assign('object', $object)
                ->header()
                ->temp('object')
                ->footer()
                ->render();
    }
  }
?>
