<?php
    namespace App;

    class Application{
        public static string $ROOT_DIR;
        public Router $router;
        public Request $request;

        public function __construct($path){
            self::$ROOT_DIR = $path;
            $this->request = new Request();
            $this->router = new Router($this->request);
        } 

        public function run(){
            $this->router->resolve();
        }
    }
?>