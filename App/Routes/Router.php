<?php
class Router {

    private $routes = [];

    public function get($route, $controller, $action) {
        $this->routes["GET_" . $route] = ['controller' => $controller, 'action' => $action];
    }

    public function post($route, $controller, $action) {
        $this->routes["POST_" . $route] = ['controller' => $controller, 'action' => $action];
    }

    public function dispath($route, $controller, $action) {
        $this->routes["DISPATCH_" . $route] = ['controller' => $controller, 'action' => $action];
    }

    public function delete($route, $controller, $action) {
        $this->routes["DELETE_" . $route] = ['controller' => $controller, 'action' => $action];
    }


    public function dispatch($uri,$method) {
        $key = $method . "_" . $uri;
        if (array_key_exists($key, $this->routes)) {
            $controller = $this->routes[$key]['controller'];
            $action = $this->routes[$key]['action'];

            $controller = new $controller();
            $controller->$action();
        } else {
            http_response_code(404);
            include('./App/Views/404.php');
            exit;
        }
    }
}