<?php
class Router
{

    private $routes = [];

    public function get($route, $controller, $action)
    {
        $this->routes["GET_" . $route] = ['controller' => $controller, 'action' => $action];
    }

    public function post($route, $controller, $action)
    {
        $this->routes["POST_" . $route] = ['controller' => $controller, 'action' => $action];
    }

    public function patch($route, $controller, $action)
    {
        $this->routes["PATCH_" . $route] = ['controller' => $controller, 'action' => $action];
    }

    public function delete($route, $controller, $action)
    {
        $this->routes["DELETE_" . $route] = ['controller' => $controller, 'action' => $action];
    }

    private function extractIdFromUri($uri)
    {
        $extracted = [];

        $result = preg_replace_callback(
            '#/(?<num>\d+)(?=/|$)#',  
            function ($matches) use (&$extracted) {
                $extracted[] = $matches['num'];  
                return '/{}';  
            },
            $uri
        );
        return [$result, $extracted];
    }

    public function dispatch($uri, $method)
    {
        $result = $this->extractIdFromUri($uri);
        $path = $result[0];
        $num = $result[1];
        $key = $method . "_" . $path;
        if (array_key_exists($key, $this->routes)) {
            $controller = $this->routes[$key]['controller'];
            $action = $this->routes[$key]['action'];

            $controller = new $controller();
            if(count($num) == 0) {
                $controller->$action();
            } else {
                $controller->$action($num[0]);
            }
        } else {
            http_response_code(404);
            include('./App/Views/404.php');
            exit;
        }
    }

}
