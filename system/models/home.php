<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class home_model extends cModel {

    public $http;
    public $user;

    function __construct() {
      global $cHttp;
      global $cUser;
      parent::__construct();
      $this->http = $cHttp;
      $this->user = $cUser;
    }

    public function get_page_start_id($param = 0) {
      return 0;
    }

    public function getObjects($beginLimit = 0) {
      $sql = 'SELECT * FROM `cms_object` LEFT JOIN `cms_album` ON `album_id` = `object_album` LEFT JOIN `cms_type` ON `type_id` = `object_type` LEFT JOIN `cms_category` ON `category_id` = `object_category` INNER JOIN `cms_users` ON `user_id` = `object_user` WHERE `object_depubdate` > :depub LIMIT ' . $beginLimit . ', 10';
      $objects = $this->getData($sql, [
        'depub' => -1
      ]);
      if($objects) {
        return $objects;
      }
      return false;
    }

    public function getObject($id) {
      $sql = 'SELECT * FROM `cms_object` LEFT JOIN `cms_album` ON `album_id` = `object_album` LEFT JOIN `cms_type` ON `type_id` = `object_type` LEFT JOIN `cms_category` ON `category_id` = `object_category` INNER JOIN `cms_users` ON `user_id` = `object_user` WHERE `object_id` = :id AND `object_depubdate` > :depub LIMIT 0,1';
      $object = $this->getData($sql, [
        'id' => $id,
        'depub' => -1
      ]);
      if($object) {
        return $object;
      }
      return false;
    }

    public function deleteObject($id) {
      $sql = 'UPDATE `cms_object` SET `object_depubdate` = :depub WHERE `object_id` = :id';
      $object = $this->getData($sql, [
        'id' => $id,
        'depub' => -1
      ]);
      return true;
    }
  }
?>
