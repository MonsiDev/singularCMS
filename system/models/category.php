<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class category_model extends cModel {

    private $treeUri = [];
    private $node;
    private $nodes_id = [];
    public $id = 0;
    public $title = '';
    public $name = '';
    public $parent = 0;
    public $type_id = 0;
    public $type_title = '';
    public $type_name = '';
    public $categories;
    public $tree;
    public $http;

    function __construct() {
      parent::__construct();
      global $cHttp;
      global $cRoute;
      $this->http = $cHttp;
      $this->treeUri = explode('/', $cRoute->getUri());
      $this->getCategories();
      $this->renderTree();
      $this->getType(array_shift($this->treeUri));
      if($this->getCategoryTree(array_shift($this->treeUri), $this->tree) === false) {
        $this->http->error404();
      }
      $this->getChildsCategoryId($this->node);
    }


    public function getChildsCategoryId($nodes) {
      if($nodes['childs']) {
        foreach($nodes['childs'] as $node) {
          $this->getChildsCategoryId($node);
        }
      }
      $this->nodes_id[] = $nodes['category_id'];
    }

    public function getType($name) {
      $type = $this->select('type')
           ->getWhere(['type_name' => $name]);
      $this->type_id = $type['type_id'];
      $this->type_title = $type['type_title'];
      $this->type_name = $type['type_name'];
    }

    public function getCategoryTree($name, $nodes) {
      foreach($nodes as $node) {
        if($node['category_name'] == $name) {
          if($node['childs'] && count($this->treeUri) > 0) {
            return $this->getCategoryTree(array_shift($this->treeUri), $node['childs']);
          }
          if(count($this->treeUri) > 0) {
            return $this->getCategoryTree(array_shift($this->treeUri), $node);
          }
          $this->node = $node;
          $this->id = $node['category_id'];
          $this->title = $node['category_title'];
          $this->name = $node['category_name'];
          $this->parent = $node['category_parent'];
          return true;
        }
      }
      return false;
    }

    public function getObjects($startLimit = 0) {
      $sql = 'SELECT * FROM `cms_object` LEFT JOIN `cms_album` ON `album_id` = object_album INNER JOIN `cms_users` ON `user_id` = object_user WHERE `object_category` IN (' . implode($this->nodes_id, ',') . ') AND `object_type` = :object_type LIMIT ' . $startLimit . ',10';
      $objects = $this->getData($sql, [
        'object_type' => $this->type_id
      ]);
      if($objects) {
        return $objects;
      }
      return false;
    }

    public function  getCategories() {
      $res = $this->select('category')
                  ->getWhere([], true);
      foreach($res as $row) {
        $this->categories[$row['category_id']] = $row;
      }
    }

    public function renderTree() {
      foreach ($this->categories as $id => &$node) {
        if (!$node['category_parent']){
          $this->tree[$id] = &$node;
        } else {
          $this->categories[$node['category_parent']]['childs'][$id] = &$node;
        }
      }
    }
  }
?>
