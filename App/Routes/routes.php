<?php

require_once "Router.php";
require_once "App/Controllers/AuthController.php";
require_once "App/Controllers/AdminController.php";
require_once "App/Controllers/BrandController.php";
require_once "App/Controllers/BodyShapeController.php";
require_once "App/Controllers/CategoryController.php";
require_once "App/Controllers/CustomerController.php";
require_once "App/Controllers/HomeController.php";
require_once "App/Controllers/OrderController.php";
require_once "App/Controllers/ProductController.php";
require_once "App/Controllers/UserController.php";

$router = new Router();

/* -----------------
*  |   Authentication 
*  -----------------
*/
$router->get("/", HomeController::class, "index");
$router->get("/collection", HomeController::class, "collection");
$router->get("/checkout", HomeController::class, "cart");


$router->get("/product/{}", HomeController::class, "product");
$router->get("/login", AuthController::class, "login");
$router->get("/register", AuthController::class, "register");
$router->post("/signin", AuthController::class, "signin");
$router->post("/signup", AuthController::class, "signup");
$router->get("/logout", AuthController::class, "logout");

/* -----------------
*  |   Admin 
*  -----------------
*/
$router->get("/admin/login", AdminController::class, "login");
$router->get("/admin/register", AdminController::class, "register");
$router->get("/admin/logout", AdminController::class, "logout");
$router->post("/admin/signin", AdminController::class, "signin");
$router->post("/admin/signup", AdminController::class, "signup");
$router->get("/admin/account", AdminController::class, "account");

$router->get("/admin", AdminController::class, "admin");
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
$router->post("/admin/products/{}", ProductController::class, "update");
$router->delete("/admin/products/{}", ProductController::class, "destroy");

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

/* -----------------
*  |    User 
*  -----------------
*/
$router->get("/admin/users", UserController::class, "index");
$router->get("/admin/users/create", UserController::class, "create");
$router->post("/admin/users", UserController::class, "store");
$router->get("/admin/users/{}/edit", UserController::class, "edit");
$router->post("/admin/users/{}", UserController::class, "update");
$router->delete("/admin/users/{}", UserController::class, "destroy");

/* -----------------
*  |   Customer 
*  -----------------
*/
$router->get("/admin/customers", CustomerController::class, "index");
$router->get("/admin/customers/{}/edit", CustomerController::class, "edit");
$router->post("/admin/customers/{}", CustomerController::class, "update");
$router->delete("/admin/customers/{}", CustomerController::class, "destroy");

/* -----------------
*  |   Order 
*  -----------------
*/
$router->get("/admin/orders", OrderController::class, "index");
$router->get("/admin/orders/{}/show", OrderController::class, "show");
$router->get("/admin/orders/{}/edit", OrderController::class, "edit");
$router->post("/orders", OrderController::class, "store");
$router->post("/admin/orders/{}", OrderController::class, "update");
$router->delete("/admin/orders/{}", OrderController::class, "destroy");