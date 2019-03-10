<?php

namespace Bird;

class BirdRoutes implements \Natalie\Routes {

    private $userTable;
    private $birdTable;
    private $authentication;
    private $categoryTable;
    private $locationTable;

    public function __construct()
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->userTable = new \Natalie\DatabaseTable($pdo, 'users', 'id');
        $this->birdTable = new \Natalie\DatabaseTable($pdo, 'birds', 'id');
        $this->authentication = new \Natalie\Authentication($this->userTable,'email', 'password');
        $this->categoryTable = new \Natalie\DatabaseTable($pdo, 'categories', 'id');
        $this->locationTable = new \Natalie\DatabaseTable($pdo, 'location', 'id');
        
    }

    public function getRoutes(): array{
           
        $birdController = new \Bird\Controllers\Bird($this->birdTable, $this->categoryTable, $this->locationTable);
        $userController = new \Bird\Controllers\Register($this->userTable);
        $loginController = new \Bird\Controllers\Login($this->authentication);

        $routes = [
            'user/register' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'registrationForm'
                ],
                'POST' => [
                    'controller' => $userController,
                    'action' => 'registerUser'
                ]
                ],
              'user/success' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'success'
                ]
              ], 
              'login' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginForm'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'processLogin'
                ]
              ],
              'login/success' => [
                    'GET' => [
                        'controller' => $loginController,
                        'action' => 'success'
                    ],
                    'login' => true
              ],
              'login/error' => [
                  'GET' => [
                      'controller' => $loginController,
                      'action' => 'error'
                  ]
                  ], 
               'logout' => [
                    'GET' => [
                        'controller' => $loginController,
                        'action' => 'logout'
                    ]
               ],   
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
                ],
                'login' => true
            ],
            'bird/delete' => [
                'POST' => [
                    'controller' => $birdController,
                    'action' => 'delete'
                ],
                'login' => true
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

    public function getAuthentication():\Natalie\Authentication {
     
        return $this->authentication;
    }
}