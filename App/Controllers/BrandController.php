<?php
require_once "Controller.php";
require_once "App/Services/BrandService.php";

class BrandController extends Controller {

    private $brandsService;

    public function __construct()
    {
       $this->brandsService = new BrandService();
    }

    public function index()
    {
        session_start();

        $brands = $this->brandsService->getAll();
        $this->view("admin.brand.index", ["brands" => $brands]);
    }

    public function create()
    {
    }


    public function store()
    {
        session_start();
        $name = $_POST["brand_name"];
        $res = $this->brandsService->insert($name);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Thêm thành công": "Thêm thất bại",
        ];
        header("location: /admin/brands");
    }

    public function show($id)
    {

    }


    public function edit()
    {
        
    }

    public function update()
    {
        
    }


    public function destroy($id)
    {
        session_start();
        $res = $this->brandsService->delete($id);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Xóa thành công": "Xóa thất bại",
        ];
        header('Content-Type: application/json');
        echo json_encode([]);
        exit();
    }
}