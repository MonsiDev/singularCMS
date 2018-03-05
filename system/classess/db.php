<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class cDBase extends PDO {

    protected static $instance;
    private $stw;

    function __construct() {
      $cfg = getConfig('db');
      $dsn = 'mysql:host=' . $cfg['host'] . ';dbname=' . $cfg['name'] . ';charset=' . $cfg['charset'];
      parent::__construct($dsn, $cfg['user'], $cfg['password'], $cfg['attr']);
    }

    public function isTable($table) {
      $get = $this->query("CHECK TABLE `{$table}`");
      if($get['Msg_text'] == 'OK') {
        return true;
      }
      return false;
    }

    public function rowsCount($table,$data = '') {
      $where = '1=1';
      if(is_array($data)) {
        $where = ':' . implode(', :', $data);
      }
      $sql = "SELECT COUNT(*) FROM {$table} WHERE {$where}";
      $this->query($sql,$data);
      return $this->stw->fetch()[0];
    }

    public function fetch() {
      return $this->stw->fetch();
    }

    public function fetchAll() {
      return $this->stw->fetchAll();
    }

    public function query($sql, $data = array()) {
      $this->stw = $this->prepare($sql);
      $this->stw->execute($data);
      return $this->stw;
    }

    public function insert($table, $data, $type = 'INSERT') {
      if(!in_array(strtoupper($type), array('REPLACE', 'INSERT'))) {
        return false;
      }
      $_keys_data = array_keys($data);
      $fields = '`' . implode('`, `', $_keys_data) . '`';
      $formats = ':' . implode(', :', $_keys_data);
      $sql = "{$type} INTO `{$table}`({$fields}) VALUES({$formats})";
      return $this->query($sql, $data);
    }

    public function update($table, $where, $data) {
      $fields = $conditions = $values = array();
      foreach($data as $field => $value) {
        $values['set_' . $field] = $value;
        $fields[] = "`{$field}` = :set_{$field}";
      }
      foreach($where as $field => $value) {
        $values['where_' . $field] = $value;
        $conditions[] = "`$field` = :where_{$field}";
      }
      $fields = implode(', ', $fields);
      $conditions = implode(' AND ', $conditions);
      $sql = "UPDATE `{$table}` SET {$fields} WHERE {$conditions}";
      return $this->query($sql, $values);
    }

    public function delete($table, $where) {
      $conditions = '1=1';
      if(!is_array($where)) {
        return false;
      }
      $conditions = array();
      foreach($where as $field => $value) {
        $conditions[] = "`{$field}` = :{$field}";
      }
      $conditions = implode(' AND ', $conditions);
      $sql = "DELETE FROM `{$table}` WHERE {$conditions}";
      return $this->query($sql, $where);
    }

    public static function getInstance() {
      if(isset(self::$instance) === false) {
        self::$instance = new self;
      }
      return self::$instance;
    }

  }
?>
