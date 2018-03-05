<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class cModel {

    protected static $instance;
    private $db;
    private $select = '';
    private $where = '';
    private $limit = '';
    private $join = '';

    function __construct() {
      global $cDBase;
      $this->db = $cDBase;
    }

    public function select($name, $option = '*') {
      $this->select = "SELECT {$option} FROM `cms_{$name}` ";
      return $this;
    }

    public function join($inner = 'LEFT', $param) {
      return $this;
    }

    public function limit($start, $end) {
      $this->limit = " LIMIT {$start},{$end}";
      return $this;
    }

    public function getWhere($data, $fetchAll = false) {
      $where = '1=1';
      if($data) {
        if(is_array($data)) {
          foreach($data as $key => $val) {
            $buff[] = "`{$key}` = :{$key}";
          }
          $where = implode($buff, ' AND ');
        } else {
          $where = $data;
        }
      }
      $this->db->query(implode('', [
        $this->select,
        $this->join,
        'WHERE ' . $where,
        $this->limit
      ]), $data);
      if($fetchAll === true) {
        return $this->db->fetchAll();
      }
      return $this->db->fetch();
    }

    public function getData($sql, $data = []) {
      $this->db->query($sql, $data);
      $data = [];
      while($row = $this->db->fetch()) {
        $data[] = (object)$row;
      }
      return $data;
    }

    public function update() {

    }

    public function insert() {

    }

    public static function getInstance() {
      if(isset(self::$instance) === false) { self::$instance = new self; }
      return self::$instance;
    }

  }
?>
