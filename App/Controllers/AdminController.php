<?php
require_once "Controller.php";
require_once "App/Services/AuthService.php";
require_once "App/Services/UserService.php";

class AdminController extends Controller {

    public $authService;
    public $userService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->userService = new UserService();
    }

    public function dashboard()
    {
        $this->view("admin.dashboard");
    }

    public function admin()
    {
        header("location: /admin/dashboard");
        exit();
    }

    public function login()
    {
        $this->view("admin.auth.login");
    }

    public function register()
    {
        $this->view("admin.auth.register");
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
        $user = $this->authService->loginAdmin($email, $password);

        if(empty($user)) {
            $this->sendError("Email hoặc mật khẩu chưa chính xác");
        }

        $_SESSION["user"] = [
            "name" => $user->user_name,
            "email" => $user->user_email,
            "id" => $user->user_id,
            "role" => "admin"
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
        $email = trim($_POST["email"]);
        $name = trim($_POST["name"]);
        $password = trim($_POST["password"]);
        $r_password = trim($_POST["repeat-password"]);
        if($password != $r_password) {
            $this->sendError("Password và nhập lại passwword không chính xác");
        }

        $user = new User();
        $user->user_name = $name;
        $user->user_email = $email;
        $user->password = $password;
        $user->address = "";
        $res = $this->userService->insert($user);

        $_SESSION["user"] = [
            "name" => $user->user_name,
            "email" => $user->user_email,
            "id" => $user->user_id,
            "role" => "admin"
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
        header("location: /admin/login");
        exit();
    }

    public function account()
    {
        $this->view("admin.account");
    }
}