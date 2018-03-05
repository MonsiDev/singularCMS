<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class object_model extends cModel {

    private $permalink_names = [];
    public $http;
    public $permalink = '';

    function __construct() {
      global $cHttp;
      global $cRoute;
      parent::__construct();
      $this->http = $cHttp;
      $this->treeUri = explode('/', $cRoute->getUri());
      $this->getCategories();
      $this->renderTree();
      $this->getType(array_shift($this->treeUri));
      if($this->getCategoryTree(array_shift($this->treeUri), $this->tree) === false) {
        $this->http->error404();
      }
      $this->permalink = '/' . $this->type_name . '/' . implode($this->permalink_names, '/');
    }

    public function getType($name) {
      $type = $this->select('type')
           ->getWhere(['type_name' => $name]);
      $this->type_id = $type['type_id'];
      $this->type_title = $type['type_title'];
      $this->type_name = $type['type_name'];
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

    public function getCategoryTree($name, $nodes) {
      foreach($nodes as $node) {
        if($node['category_name'] == $name) {
          $this->permalink_names[] = $name;
          if($node['childs'] && count($this->treeUri) > 1) {
            return $this->getCategoryTree(array_shift($this->treeUri), $node['childs']);
          }
          if(count($this->treeUri) > 1) {
            return $this->getCategoryTree(array_shift($this->treeUri), $node);
          }
          $this->node = $node;
          $this->category_id = $node['category_id'];
          $this->category_title = $node['category_title'];
          $this->category_name = $node['category_name'];
          $this->category_parent = $node['category_parent'];
          return true;
        }
      }
      return false;
    }

    public function getObject($param) {
      $pop = array_pop($param);
      if(preg_match("/(\.html)$/i", $pop)) {
        $name = substr($pop, 0, strpos($pop, '.html'));
        $sql = 'SELECT * FROM `cms_object` INNER JOIN `cms_users` ON `user_id` = `object_user` LEFT JOIN `cms_album` ON `album_id` = `object_album` WHERE `object_type` = :object_type AND `object_category` = :object_category AND `object_name` = :object_name';
        $object = $this->getData($sql, [
          'object_type' => $this->type_id,
          'object_category' => $this->category_id,
          'object_name' => $name
        ]);
        if($object) {
          return $object[0];
        }
      }
      return false;
    }

  }
?>
