<?php
require_once "Controller.php";
require_once "App/Services/CustomerService.php";
require_once "App/Models/Customer.php";

class CustomerController extends Controller {

    public $customerService;

    public function __construct()
    {
        $this->customerService = new customerService();
    }

    public function index()
    {
        $customers = $this->customerService->getAll();
        $this->view("admin.customer.index", [ "customers" => $customers]);
    }

    public function create()
    {
        $this->view("admin.customer.create");
    }


    public function store()
    {

        if(!isset($_POST["customer_name"]) || empty($_POST["customer_name"])) {
            $this->sendError("Thiếu tên");
        }
        $name = $_POST['customer_name'];

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

        $customer = new customer();
        $customer->customer_name = $name;
        $customer->customer_email = $email;
        $customer->password = $password;
        $customer->address = $address;

        header('Content-Type: application/json');

        $res = $this->customerService->insert($customer);

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
        $customer = $this->customerService->getOne($id);
        $this->view("admin.customer.edit", [ "customer" => $customer]);
    }

    public function update($id)
    {

        if(!isset($_POST["customer_name"]) || empty($_POST["customer_name"])) {
            $this->sendError("Thiếu tên");
        }
        $name = $_POST['customer_name'];

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

        $customer = new customer();
        $customer->customer_id = $id;
        $customer->customer_name = $name;
        $customer->customer_email = $email;
        $customer->password = $password;
        $customer->address = $address;

        header('Content-Type: application/json');

        $res = $this->customerService->update($customer);

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
        $res = $this->customerService->delete($id);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Xóa thành công": "Xóa thất bại",
        ];
        header('Content-Type: application/json');
        echo json_encode([]);
        exit();
    }

}


