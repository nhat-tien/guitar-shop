<?php

require_once "Router.php";
require_once "App/Controllers/HomeController.php";
require_once "App/Controllers/AuthController.php";

$router = new Router();

$router->get("/", HomeController::class, "index");
$router->get("/admin/register", AuthController::class, "registerAdminView");
$router->post("/admin/register", AuthController::class, "registerUser");