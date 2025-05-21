<?php
require_once "Controller.php";
require_once "App/Services/CategoryService.php";
require_once "App/Models/Category.php";

class CategoryController extends Controller {

    private $categoryService;

    public function __construct()
    {
       $this->categoryService = new CategoryService();
    }

    public function index()
    {

        $categories = $this->categoryService->getAll();
        $this->view("admin.category.index", ["categories" => $categories]);
    }

    public function create()
    {
    }


    public function store()
    {
        $name = $_POST["category_name"];
        $res = $this->categoryService->insert($name);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Thêm thành công": "Thêm thất bại",
        ];
        header("location: /admin/categories");
    }

    public function show($id)
    {

    }


    public function edit()
    {
        
    }

    public function update($id)
    {
        $name = $_POST['category_name'];
        $category = new Category();
        $category->category_name = $name;
        $category->category_id = $id;
        $res = $this->categoryService->update($category);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Cập nhật thành công": "Cập nhật thất bại",
        ];
        header("location: /admin/categories");
    }


    public function destroy($id)
    {
        $res = $this->categoryService->delete($id);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Xóa thành công": "Xóa thất bại",
        ];
        header('Content-Type: application/json');
        echo json_encode([]);
        exit();
    }
}