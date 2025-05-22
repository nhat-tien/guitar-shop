<?php
require_once("Controller.php");
require_once("App/Services/AuthService.php");
require_once("App/Services/CustomerService.php");
require_once("App/Models/Customer.php");

class AuthController extends Controller {

    private $authService;
    private $customerService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->customerService = new CustomerService();
    }


    public function login()
    {
        $this->view("login");
    }

    public function register()
    {
        $this->view("register");
    }

    public function signin()
    {
        if(!isset($_POST["email"]) || empty($_POST["email"])) {
            $this->sendError("Chưa điền email");
        }
        if(!isset($_POST["password"]) || empty($_POST["password"])) {
            $this->sendError("Chưa điền password");
        }
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $user = $this->authService->loginCustomer($email, $password);

        if(empty($user)) {
            $this->sendError("Email hoặc mật khẩu chưa chính xác");
        }

        $_SESSION["user"] = [
            "name" => $user->customer_name,
            "email" => $user->customer_email,
            "id" => $user->customer_id,
            "role" => "customer"
        ];

        $_SESSION['response'] = [ 
            "status" => true,
            "message" =>  "Đăng nhập thành công"
        ];

        echo json_encode([
            "status" => true,
            "message" =>  "Đăng nhập thành công"
        ]);

        exit();
    }

    public function signup()
    {

        if(!isset($_POST["name"]) || empty($_POST["name"])) {
            $this->sendError("Chưa điền tên");
        }
        if(!isset($_POST["email"]) || empty($_POST["email"])) {
            $this->sendError("Chưa điền email");
        }
        if(!isset($_POST["password"]) || empty($_POST["password"])) {
            $this->sendError("Chưa điền password");
        }
        if(!isset($_POST["repeat-password"]) || empty($_POST["repeat-password"])) {
            $this->sendError("Nhập lại password");
        }
        if(!isset($_POST["address"]) || empty($_POST["address"])) {
            $this->sendError("Chưa điền địa chỉ");
        }
        $email = trim($_POST["email"]);
        $name = trim($_POST["name"]);
        $address = trim($_POST["address"]);
        $password = trim($_POST["password"]);
        $r_password = trim($_POST["repeat-password"]);
        if($password != $r_password) {
            $this->sendError("Password và nhập lại passwword không chính xác");
        }

        $user = new Customer();
        $user->customer_name = $name;
        $user->customer_email = $email;
        $user->password = $password;
        $user->address = $address;
        $res = $this->customerService->insert($user);

        $_SESSION["user"] = [
            "name" => $user->customer_name,
            "email" => $user->customer_email,
            "id" => $user->customer_id,
            "role" => "customer"
        ];

        $_SESSION['response'] = [ 
            "status" => true,
            "message" =>  "Đăng kí thành công"
        ];

        echo json_encode([
            "status" => true,
            "message" =>  "Đăng kí thành công"
        ]);

        exit();
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header("location: /");
        exit();
    }

}