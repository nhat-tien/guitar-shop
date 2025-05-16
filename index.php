<?php

$uri = $_SERVER["REQUEST_URI"];
require "./App/Routes/routes.php";
$router->dispatch($uri);
