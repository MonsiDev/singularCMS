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
