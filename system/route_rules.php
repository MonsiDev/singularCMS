<?php
  return [
    "/^$/i" => [
      'controller' => 'homepage',
      'action' => 'index'
    ],
    "/^(home)$/i" => [
      'controller' => 'home',
      'action' => 'index'
    ],
    "/^(home)\/(auth)$/i" => [
      'controller' => 'home',
      'action' => 'auth'
    ],
    "/^(home)\/(add)$/i" => [
      'controller' => 'home',
      'action' => 'add'
    ],
    "/^(home)\/(edit)$/i" => [
      'controller' => 'home',
      'action' => 'edit'
    ],
    "/^(home)\/(view)$/i" => [
      'controller' => 'home',
      'action' => 'view'
    ],
    "/^(home)\/(search)$/i" => [
      'controller' => 'home',
      'action' => 'search'
    ],
    "/^(home)\/(delete)$/i" => [
      'controller' => 'home',
      'action' => 'delete'
    ],
    "/^(home)\/(logout)$/i" => [
      'controller' => 'home',
      'action' => 'logout'
    ],
    "/^((rental)|(rupal)|(sale))$/i" => [
      'controller' => 'type',
      'action' => 'index'
    ],
    "/^((rental)|(rupal)|(sale))\/([0-9a-zA-Z?\/]*+)(?!(\.html))$/i" => [
      'controller' => 'category',
      'action' => 'index'
    ],
    "/^((rental)|(rupal)|(sale))\/([0-9a-zA-Z.?\/]*+)$/i" => [
      'controller' => 'object',
      'action' => 'index'
    ],
    "/^(search)$/i" => [
      'controller' => 'search',
      'action' => 'index'
    ]
  ];
