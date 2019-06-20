<?php
namespace Natalie;

    class EntryPoint
    {
        private $route;
        private $routes;
        private $method;

        public function __construct(string $route, \Natalie\Routes $routes,string $method){
            $this->route = $route;
            $this->routes = $routes;
            $this->method = $method;
            $this->checkUrl();
        }

        private function checkUrl() {
            if($this->route !== strtolower($this->route)){
                http_response_code(301);
                header('location: ' . strtolower($this->route));
            }
        }

        private function loadTemplate($templateFileName, $variables = []){
            extract($variables);
            ob_start();
            include __DIR__ . '/../../templates/' . $templateFileName;
            return ob_get_clean();

        }



        public function run(){
         
            $routes = $this->routes->getRoutes();      
            $authentication = $this->routes->getAuthentication();

            if(isset($routes[$this->route]['login']) && $routes[$this->route]['login'] && !$authentication->isLoggedIn()){
                header('location: /login/error');
            }else{
                if(isset($routes[$this->route]['admin']) && $routes[$this->route]['admin'] && !$authentication->isAdmin()){
                    header('TTP/1.0 403 Forbidden', true, 403);
                    exit;
                }
                $controller = $routes[$this->route][$this->method]['controller'];
                $action = $routes[$this->route][$this->method]['action'];
                $page_redirect = $controller->$action();
                $page_title = $page_redirect['title'];
                if(isset($_GET['id'])){
                include __DIR__ . '/../../includes/DatabaseConnection.php';
                $sightingsTable = new \Natalie\DatabaseTable($pdo, 'sightings', 'id');
                $usersTable = new \Natalie\DatabaseTable($pdo, 'users', 'id');
                $google = new \File\GoogleMap($sightingsTable, $usersTable);
                $coords = $google->getCoordArray($_GET['id']);
                }else{
                    $coords = '';
                }

                if(isset($page_redirect['message'])){
                    $message = $page_redirect['message'];
                }
                if(isset($page_redirect['variables'])){
                    $output = $this->loadTemplate($page_redirect['template'], $page_redirect['variables']);
                }else{
                    $output = $this->loadTemplate($page_redirect['template']);
                }
            
                echo $this->loadTemplate('layout.html.php', [
                    'loggedIn' => $authentication->isLoggedIn(),
                    'output' => $output,
                    'page_title' => $page_title,
                    'coordinates' => $coords,
                    'route' => $this->route

                ]);

            }
            

        }
    }