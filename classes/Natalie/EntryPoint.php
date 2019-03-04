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
                $controller = $routes[$this->route][$this->method]['controller'];
                $action = $routes[$this->route][$this->method]['action'];
                $page_redirect = $controller->$action();
                $page_title = $page_redirect['title'];
    
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
                    'page_title' => $page_title
                ]);

            }
            

        }
    }