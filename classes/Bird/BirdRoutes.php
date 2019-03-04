<?php

namespace Bird;

class BirdRoutes {


    public function getRoutes(){
        include_once '../config/core.php';
        include_once '../includes/DatabaseConnection.php';


        $birdTable = new \Natalie\DatabaseTable($pdo, 'birds', 'id');
        $categoryTable = new \Natalie\DatabaseTable($pdo, 'categories', 'id');
        $locationTable = new \Natalie\DatabaseTable($pdo, 'location', 'id');
        $userTable = new \Natalie\DatabaseTable($pdo, 'user', 'id');
        $birdController = new \Bird\Controllers\Bird($birdTable, $categoryTable, $locationTable);

        $routes = [
            'bird/read' => [
                'GET' => [
                    'controller' => $birdController,
                    'action' => 'read'
                ]
                ],
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
                  'action' => 'list'
              ]
            ],
            '' => [
            'GET' => [
                'controller' => $birdController,
                'action' => 'list'
               ]
            ]
        ];
        
        return $routes;
    }
}