<?php
require_once "Controller.php";
require_once "App/Services/AuthService.php";

class AdminController extends Controller {

    public $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
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

    }
}