<?php
require_once("Controller.php");
require_once("App/Services/AuthService.php");

class AuthController extends Controller {

    private AuthService $authService;

    public function __construct()
    {
        $authService = new AuthService();
    }


    public function loginCustomerView() 
    {
        $this->view("customer.login");
    }

    public function loginAdminView() 
    {
        $this->view("admin.login");
    }

    public function loginCustomer() 
    {

    }

    public function registerCustomer() 
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $this->authService->registerCustomer($name, $email, $password);
    }
}