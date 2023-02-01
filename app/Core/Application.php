<?php
class Application {
    private $controller = "PageController";
    private $action = "processRequest";
    private $params = [];

    public function __construct() {
        $this->prepareURL();
        if(file_exists( CONTROLLER . $this->controller . '.php')) {
        
            $this->controller = new $this->controller;
            if(method_exists($this->controller, $this->action)) {
                call_user_func_array([$this->controller, $this->action], $this->params);
            }
        
        }
    }
    protected function prepareURL() {
        
        $request = trim($_SERVER['REQUEST_URI'], '/');
        
        if(!empty($request)) {
        
            $url = explode('/', $request);
            $this->controller = isset($url[0]) ? $url[0] . "Controller" : "PageController";
            unset($url[0]);
            $url = !empty($url) ? array_values($url) : [];
            array_unshift($url, $_SERVER['REQUEST_METHOD']);
            $this->params = $url;
        }
    }
}