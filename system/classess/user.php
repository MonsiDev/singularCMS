<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class cUser {

    protected static $instance;
    public $id = 0;
    public $name = '';
    public $gid = 0;
    public $phone = '';
    public $email = '';
    public $avatar = '';
    public $nickname = '';
    public $is_auth = false;

    function __construct() {
      if($this->getSession('id')) {
        if($this->getSession('remote_addr') != $_SERVER['REMOTE_ADDR']
          && $this->getSession('user_agent') != $_SERVER['HTTP_USER_AGENT']) {
          $this->unsetSession();
        } else {
          $user = $this->getUser([
            'user_id' => $this->getSession('id'),
            'user_delete' => false
          ]);

          if($user === false) {
            $this->unsetSession();
          } else {
            $this->id = $user['user_id'];
            $this->name = $user['user_name'];
            $this->gid = $user['user_gid'];
            $this->phone = $user['user_phone'];
            $this->email = $user['user_mail'];
            $this->avatar = $user['user_photo'];
            $this->nickname = $user['user_nickname'];
            $this->is_auth = true;
          }
        }
      }
    }

    public function unsetSession() {
      session_destroy();
      header('Location: /');
    }

    public function getSession($key) {
      if(isset($_SESSION['USER'][$key]) == true) {
        return $_SESSION['USER'][$key];
      }
      return false;
    }

    public function setSession($key, $val) {
      if(is_array($key)) {
        foreach($key as $k => $v) {
          $_SESSION['USER'][$k] = $v;
        }
      } else {
        $_SESSION['USER'][$key] = $val;
      }
    }

    public function authUser($name, $pass, $redirect = '/home') {
      global $cHttp;
      $name = strtolower($name);
      $user = $this->getUser(['user_name' => $name]);
      if($user !== false) {
        if($this->validPass($user['user_password'], [
            'login' => $name,
            'password' => $pass
          ])) {
          $this->setSession([
            'id' => $user['user_id'],
            'remote_addr' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
          ]);
          $cHttp->redirect($redirect);
          return true;
        }
      }
      return false;
    }

    public function regUser() {

    }

    public function getUser($data) {
      global $cDBase;
      foreach($data as $key => $value) {
        $where[] = "`{$key}` = :{$key}";
      }
      $sql = 'SELECT * FROM `cms_users` WHERE ' . implode($where, ' AND ');
      $cDBase->query($sql, $data);
      return $cDBase->fetch();
    }

    public function hashPass($login, $pass) {
      $login = strtolower($login);
      $len = strlen($login);
      $bonding = implode([
        md5($login . md5($pass . $pass[PI() / $len])),
        md5($login[$len % PI()] . sha1($pass)),
        $pass[$len % PI()] . sha1($login)[$len / PI() * 2] . $pass
      ], '$');
      return sha1($bonding);
    }

    public function validPass($pass_in, $user_data) {
      return ($pass_in === $this->hashPass($user_data['login'], $user_data['password']));
    }

    public function getUsers() {

    }

    public static function getInstance() {
      if(isset(self::$instance) === false) { self::$instance = new self; }
      return self::$instance;
    }
  }
?>
