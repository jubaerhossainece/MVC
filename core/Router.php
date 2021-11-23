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
            $callback = $this->routes[$method][$path] ?? false;
            if($callback === false){
                echo "Not found!";
                exit;
            }
            if(is_string($callback)){
                echo $this->renderView($callback); return;
            }
            return call_user_func($callback);
        }


        public function renderView($view){
            $viewContent = $this->renderOnlyView($view);
            $layoutContent = $this->layoutContent($viewContent);
            
            if($layoutContent){
                $pattern = '/@apply\(([\'\"])(\S+)(\1)\)?/i';
                $viewContent = preg_replace($pattern, '', $viewContent);
                $viewContent = preg_replace('/@endapply/', '', $viewContent);
                return str_replace('@setContent',$viewContent, $layoutContent);
            }else{
                return $viewContent;
            }
        }

        protected function layoutContent($view){
            $pattern = '/@apply\(([\'\"])(\S+)(\1)\)?/i';
            $result = preg_match($pattern, $view, $matches);

            if($result){
                $matches[2];
                $dirs = str_replace('.','/', $matches[2]);
                ob_start();
                include_once Application::$ROOT_DIR."/../views/$dirs.view.php";
                return ob_get_clean();
            }else{
                return false;
            }
        }

        protected function renderOnlyView($view){
            ob_start();
            include_once Application::$ROOT_DIR."/../views/$view.view.php";
            return ob_get_clean();
        }
    }
?>