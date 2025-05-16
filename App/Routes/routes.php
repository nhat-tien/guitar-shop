<?php
require_once "Router.php";
require_once "App/Controllers/HomeController.php";

$router = new Router();

$router->addRoute("/", HomeController::class, "index");