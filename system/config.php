<?php
  if(defined('BASEPATH') === false) {
    exit;
  }

  function getConfig($key) {
    $cfg = [
      'db' => [
        'user' => 'root',
        'password' => '',
        'name' => 'oasis',
        'host' => 'localhost',
        'charset' => 'utf8',
        'attr' => [
            PDO::ATTR_PERSISTENT => true
        ]
      ],
      'site' => [
        'title' => 'Агенство недвижимости Оазис КМВ',
        'keywords' => ['Оазис КМВ'],
        'description' => ''
      ],
      'password_hash_algo' => PASSWORD_BCRYPT,
      'password_hash_options' => [
        'const' => 11
      ]
    ];
    if(isset($cfg[$key]) === true) {
      return $cfg[$key];
    }
    return false;
  }
