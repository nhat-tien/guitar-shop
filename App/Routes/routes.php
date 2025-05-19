<?php

require_once "Router.php";
require_once "App/Controllers/HomeController.php";
require_once "App/Controllers/AuthController.php";
require_once "App/Controllers/ProductController.php";
require_once "App/Controllers/AdminController.php";
require_once "App/Controllers/BrandController.php";
require_once "App/Controllers/BodyShapeController.php";
require_once "App/Controllers/CategoryController.php";

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

/* -----------------
*  |   Brand 
*  -----------------
*/
$router->get("/admin/brands", BrandController::class, "index");
$router->post("/admin/brands", BrandController::class, "store");
$router->post("/admin/brands/{}", BrandController::class, "update");
$router->delete("/admin/brands/{}", BrandController::class, "destroy");

/* -----------------
*  |   Body Shape 
*  -----------------
*/
$router->get("/admin/body-shapes", BodyShapeController::class, "index");
$router->post("/admin/body-shapes", BodyShapeController::class, "store");
$router->post("/admin/body-shapes/{}", BodyShapeController::class, "update");
$router->delete("/admin/body-shapes/{}", BodyShapeController::class, "destroy");

/* -----------------
*  |   Category 
*  -----------------
*/
$router->get("/admin/categories", CategoryController::class, "index");
$router->post("/admin/categories", CategoryController::class, "store");
$router->post("/admin/categories/{}", CategoryController::class, "update");
$router->delete("/admin/categories/{}", CategoryController::class, "destroy");