<?php
require_once "Controller.php";
require_once "App/Services/UserService.php";
require_once "App/Models/User.php";

class UserController extends Controller {

    public $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        $users = $this->userService->getAll();
        $this->view("admin.user.index", [ "users" => $users]);
    }

    public function create()
    {
        $this->view("admin.user.create");
    }


    public function store()
    {

        if(!isset($_POST["user_name"]) || empty($_POST["user_name"])) {
            $this->sendError("Thiếu tên");
        }
        $name = $_POST['user_name'];

        if(!isset($_POST["email"]) || empty($_POST["email"])) {
            $this->sendError("Thiếu email");
        }
        $email = $_POST['email'];

        if(!isset($_POST["password"]) || empty($_POST["password"])) {
            $this->sendError("Thiếu password");
        }
        $password = $_POST['password'];

        if(!isset($_POST["address"]) || empty($_POST["address"])) {
            $this->sendError("Thiếu địa chỉ");
        }
        $address = $_POST['address'];

        $user = new User();
        $user->user_name = $name;
        $user->user_email = $email;
        $user->password = $password;
        $user->address = $address;

        header('Content-Type: application/json');

        $res = $this->userService->insert($user);

        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Thêm thành công": $res["message"],
        ];

        echo json_encode([
            "status" => $res['status'],
            "message" => $res['status'] ? "Thêm thành công": $res["message"],
        ]);
        exit();
    }

    public function show($id)
    {
    }


    public function edit($id)
    {
        $user = $this->userService->getOne($id);
        $this->view("admin.user.edit", [ "user" => $user]);
    }

    public function update($id)
    {

        if(!isset($_POST["user_name"]) || empty($_POST["user_name"])) {
            $this->sendError("Thiếu tên");
        }
        $name = $_POST['user_name'];

        if(!isset($_POST["email"]) || empty($_POST["email"])) {
            $this->sendError("Thiếu email");
        }
        $email = $_POST['email'];

        // if(!isset($_POST["password"]) || empty($_POST["password"])) {
        //     $this->sendError("Thiếu password");
        // }
        $password = $_POST['password'];

        if(!isset($_POST["address"]) || empty($_POST["address"])) {
            $this->sendError("Thiếu địa chỉ");
        }
        $address = $_POST['address'];

        $user = new User();
        $user->user_id = $id;
        $user->user_name = $name;
        $user->user_email = $email;
        $user->password = $password;
        $user->address = $address;

        header('Content-Type: application/json');

        $res = $this->userService->update($user);

        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Cập nhật thành công": $res["message"],
        ];

        echo json_encode([
            "status" => $res['status'],
            "message" => $res['status'] ? "Cập nhật thành công": $res["message"],
        ]);
        exit();
    }


    public function destroy($id)
    {
        $res = $this->userService->delete($id);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Xóa thành công": "Xóa thất bại",
        ];
        header('Content-Type: application/json');
        echo json_encode([]);
        exit();
    }

}
