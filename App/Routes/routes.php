<?php

require_once "Router.php";
require_once "App/Controllers/HomeController.php";
require_once "App/Controllers/AuthController.php";
require_once "App/Controllers/ProductController.php";
require_once "App/Controllers/AdminController.php";

$router = new Router();


/* -----------------
*  |   Authentication 
*  -----------------
*/
$router->get("/", HomeController::class, "index");
$router->get("/admin/register", AuthController::class, "registerAdminView");
$router->post("/admin/register", AuthController::class, "registerUser");
/* -----------------
*  |   Admin 
*  -----------------
*/
$router->get("/admin/dashboard", AdminController::class, "dashboard");
/* -----------------
*  |    Product
*  -----------------
*/
$router->get("/admin/products", ProductController::class, "index");
$router->get("/admin/products/create", ProductController::class, "create");
$router->post("/admin/products", ProductController::class, "store");
$router->get("/admin/products/{}/show", ProductController::class, "show");
$router->get("/admin/products/{}/edit", ProductController::class, "edit");
$router->patch("/admin/products/{}/update", ProductController::class, "update");
$router->delete("/admin/products/{}/delete", ProductController::class, "destroy");