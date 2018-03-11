<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class type_model extends cModel {

    public $http;
    public $title = '';
    public $name = '';
    public $id = '';

    function __construct() {
      global $cHttp;
      parent::__construct();
      $this->http = $cHttp;
    }

    public function getSelf() {
      global $cRoute;
      $name = $cRoute->getUri();
      $data = $this->select('type')->getWhere([
        'type_name' => $name
      ]);
      $this->title = $data['type_title'];
      $this->name = $data['type_name'];
      $this->id = $data['type_id'];
    }

    public function getObjects($beginLimit = 0) {
      $sql = 'SELECT * FROM `cms_object` LEFT JOIN `cms_album` ON `album_id` = `object_album` INNER JOIN `cms_users` ON `user_id` = `object_user` WHERE `object_type` = :object_type LIMIT ' . $beginLimit . ', 10';
      $objects = $this->getData($sql, [
        'object_type' => $this->id
      ]);
      if($objects) {
        return $objects;
      }
      return false;
    }

  }
?>
