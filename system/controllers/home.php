<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  class my_home extends cController{

    public $model;
    public $assign = [];

    function __construct($name) {
      parent::__construct();
      $this->model = $this->loadModel($name);
      $this->assign['msg'] = [
        'status' => 'OK',
        'text' => ''
      ];
      $this->assign['user'] = [
        'id' => $this->model->user->id,
        'name' => $this->model->user->name,
        'gid' => $this->model->user->gid,
        'phone'  => $this->model->user->phone,
        'email' => $this->model->user->email,
        'avatar' => $this->model->user->avatar,
        'nickname' => $this->model->user->nickname,
        'is_auth' => $this->model->user->is_auth
      ];
    }

    public function index($params) {
      if($this->model->user->is_auth === false) {
        $this->model->http->redirect('/home/auth');
      } else {
        $this->model->http->redirect('/home/view?type=object');
      }
    }

    public function auth() {
      if($this->model->user->is_auth === true) {
        $this->model->http->redirect('/home/view?type=object');
      }
      if(isset($_POST['login']) === true &&
         isset($_POST['password']) === true) {
        if(empty($_POST['login']) === true ||
           empty($_POST['password']) === true) {
            $this->assign['msg'] = [
              'status' => 'ERROR',
              'text' => 'Не введён логин или пароль'
            ];
        } else {
          if($this->model->user->authUser($_POST['login'], $_POST['password']) === false) {
            $this->assign['msg'] = [
              'status' => 'ERROR',
              'text' => 'Не верно введён логин или пароль'
            ];
          }
        }
      }
      if(isAjax() === true) {
        jsonSend($this->assign);
      }
      $this->tmp->siteTitle('Вход в панель управления')
                 ->header('home')
                 ->assign($this->assign)
                 ->temp('home/auth')
                 ->footer('home')
                 ->render();
    }

    public function add() {
      if($this->model->user->is_auth == false) {
        $this->model->http->redirect('/home/auth');
      }
      $this->tmp->siteTitle('Добавить объект')
                 ->header('home')
                 ->assign($this->assign)
                 ->temp('home/add')
                 ->footer('home')
                 ->render();
    }

    public function edit() {
      if($this->model->user->is_auth == false) {
        $this->model->http->redirect('/home/auth');
      }
    }

    public function view() {
      if($this->model->user->is_auth == false) {
        $this->model->http->redirect('/home/auth');
      }
      $get = filter_input_array(INPUT_GET, [
        'type' => FILTER_DEFAULT,
        'id' => FILTER_VALIDATE_INT,
        'page' => FILTER_VALIDATE_INT
      ]);

      if(isset($get['id']) == true) {
        $object = $this->model->getObject($get['id']);
        if($object === false) {
          $this->model->http->error404();
        }
        $this->assign['object'] = $object;
        $view = 'home/view_single';
      } else {
        $objects = $this->model->getObjects($this->model->get_page_start_id($get['page']));
        if($objects === false) {
          $this->model->http->error404();
        }
        $this->assign['objects'] = $objects;
        $view = 'home/view';
      }
      $this->tmp->siteTitle('Панель управления')
                 ->header('home')
                 ->assign($this->assign)
                 ->temp($view)
                 ->footer('home')
                 ->render();
    }

    public function delete() {
      if($this->model->user->is_auth == false) {
        $this->model->http->redirect('/home/auth');
      }
      $get = filter_input_array(INPUT_GET, [
        'type' => FILTER_DEFAULT,
        'id' => FILTER_VALIDATE_INT
      ]);
      if(isset($get['id']) == true) {
        $object = $this->model->getObject($get['id'])[0];
        if($object->user_id === $this->model->user->id) {
          $this->model->deleteObject($get['id']);
        }
      }
      $this->model->http->redirect('/home/view?type=object');
    }

    public function search() {
      if($this->model->user->is_auth == false) {
        $this->model->http->redirect('/home/auth');
      }
    }

    public function logout() {
      if($this->model->user->is_auth == false) {
        $this->model->http->redirect('/home/auth');
      }
      $this->model->user->unsetSession();
      $this->model->http->redirect('/');
    }
  }
?>
