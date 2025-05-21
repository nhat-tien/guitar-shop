<?php
require_once "Controller.php";
require_once "App/Services/BrandService.php";
require_once "App/Models/Brand.php";

class BrandController extends Controller {

    private $brandsService;

    public function __construct()
    {
       $this->brandsService = new BrandService();
    }

    public function index()
    {
        $brands = $this->brandsService->getAll();
        $this->view("admin.brand.index", ["brands" => $brands]);
    }

    public function create()
    {
    }


    public function store()
    {
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

    public function update($id)
    {
        $name = $_POST['brand_name'];
        $brand = new Brand();
        $brand->brand_name = $name;
        $brand->brand_id = $id;
        $res = $this->brandsService->update($brand);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Cập nhật thành công": "Cập nhật thất bại",
        ];
        header("location: /admin/brands");
    }


    public function destroy($id)
    {
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