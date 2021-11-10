<?php
    namespace App;

    class Router{
        protected array $routes = [];
        public Request $request;

        public function __construct(Request $request){
            $this->request =  $request;
        }

        public function get($path, $callback){
            $this->routes['get'][$path] = $callback;
        }

        public function resolve(){
            $path = $this->request->getPath();
            $method = $this->request->getMethod();
            $calback = $this->routes->$method->$path;
            echo "<pre>";
            var_dump($this->routes[$method][$path]);
            echo "</pre>";
        }
    }
?>