<?php
require_once("Controller.php");
require_once("App/Services/AuthService.php");

class AuthController extends Controller {

    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }


    public function loginCustomerView() 
    {
        $this->view("customer.login");
    }

    public function loginAdminView() 
    {
        $this->view("admin.login");
    }

    public function registerAdminView() 
    {
        $this->view("admin.register");
    }

    public function loginCustomer() 
    {

    }

    public function registerUser() 
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $this->authService->registerUser($name, $email, $password);
        $this->view("admin.register", ["status" => true]);
    }
}