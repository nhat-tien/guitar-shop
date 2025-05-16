<?php

$uri = $_SERVER["REQUEST_URI"];
$method = $_SERVER['REQUEST_METHOD'];

require "./App/Routes/routes.php";

$router->dispatch($uri, $method);
