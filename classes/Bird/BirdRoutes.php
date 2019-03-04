<?php

namespace Bird;

class BirdRoutes {


    public function callAction($route){
        include_once '../config/core.php';
        include_once '../includes/DatabaseConnection.php';


        $birdTable = new \Natalie\DatabaseTable($pdo, 'birds', 'id');
        $categoryTable = new \Natalie\DatabaseTable($pdo, 'categories', 'id');
        $locationTable = new \Natalie\DatabaseTable($pdo, 'location', 'id');
        $userTable = new \Natalie\DatabaseTable($pdo, 'user', 'id');
        $birdController = new \Bird\Controllers\Bird($birdTable, $categoryTable, $locationTable);

        $routes = [
            'bird/edit' => [
                'POST' => [
                    'controller' => $birdController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $birdController,
                    'action' => 'edit'
                ]
            ],
            'bird/delete' => [
                'POST' => [
                    'controller' => $birdController,
                    'action' => 'delete'
                ]
            ],
            'home' => [
              'GET' => [
                  'controller' => $birdController,
                  'action' => 'home'
              ]
            ],
            '' => [
            'GET' => [
                'controller' => $birdController,
                'action' => 'home'
               ]
            ]
        ];

        $method = $_SERVER['REQUEST_METHOD'];
        $controller = $routes[$route][$method]['controller'];
        $action = $routes[$route][$method]['action'];
        return $controller->$action();
    }
}