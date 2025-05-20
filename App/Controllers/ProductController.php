<?php
require_once "Controller.php";
require_once "App/Services/ProductService.php";
require_once "App/Services/BrandService.php";
require_once "App/Services/BodyShapeService.php";
require_once "App/Services/CategoryService.php";

class ProductController extends Controller {

    public $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        session_start();
        $products = $this->productService->getAll();
        $this->view("admin.product.index", ["products" => $products]);
    }

    public function create()
    {
        $brandService = new BrandService();
        $brands = $brandService->getAll();

        $bodyShapeService = new BodyShapeService();
        $bodyShapes = $bodyShapeService->getAll();

        $categoryService = new CategoryService();
        $categories = $categoryService->getAll();

        $this->view("admin.product.create", [
            "brands" => $brands,
            "bodyShapes" => $bodyShapes,
            "categories" => $categories
        ]);
    }


    public function store()
    {
        session_start();
        $product = new Product();
        if(!isset($_POST["product_name"]) || empty($_POST["product_name"])) {
            $this->sendError("Thiếu tên sản phẩm");
        }
        $product->product_name = $_POST["product_name"];
        if(!isset($_POST["quantity"]) || empty($_POST["quantity"])) {
            $this->sendError("Thiếu số lượng");
        }
        $product->quantity = $_POST["quantity"];
        if(!isset($_POST["base_price"]) || empty($_POST["base_price"])) {
            $this->sendError("Thiếu giá");
        }
        $product->base_price = $_POST["base_price"];
        $product->price_unit = $_POST["price_unit"];
        $product->discount = $_POST["discount"];
        $product->discount_unit = $_POST["discount_unit"];
        if(!isset($_POST["number_of_string"]) || empty($_POST["number_of_string"])) {
            $this->sendError("Thiếu số lượng dây");
        }
        $product->number_of_string = $_POST["number_of_string"];
        if(!isset($_POST["brand_id"]) || empty($_POST["brand_id"])) {
            $this->sendError("Thiếu thương hiệu");
        }
        $product->brand_id = $_POST["brand_id"];
        if(!isset($_POST["category_id"]) || empty($_POST["category_id"])) {
            $this->sendError("Thiếu danh mục");
        }
        $product->category_id = $_POST["category_id"];
        if(!isset($_POST["body_shape_id"]) || empty($_POST["body_shape_id"])) {
            $this->sendError("Thiếu dáng đàn");
        }
        $product->body_shape_id = $_POST["body_shape_id"];
        if(!isset($_POST["description"]) || empty($_POST["description"])) {
            $this->sendError("Thiếu mô tả");
        }
        $product->description = $_POST["description"];
        if(!isset($_POST["body_material"]) || empty($_POST["body_material"])) {
            $this->sendError("Thiếu chất liệu thân đàn");
        }
        $product->body_material = $_POST["body_material"];
        if(!isset($_POST["fretboard_material"]) || empty($_POST["fretboard_material"])) {
            $this->sendError("Thiếu chất liệu cần đàn");
        }
        $product->fretboard_material = $_POST["fretboard_material"];
        if(!isset($_POST["scale_length"]) || empty($_POST["scale_length"])) {
            $this->sendError("Thiếu chiều dài dây");
        }
        $product->scale_length = $_POST["scale_length"];
        if(!isset($_POST["no_of_fret"]) || empty($_POST["no_of_fret"])) {
            $this->sendError("Thiếu số lượng phím");
        }
        $product->no_of_fret = $_POST["no_of_fret"];

        header('Content-Type: application/json');

        $count = count($_FILES);
        if ($count < 1) {
            echo json_encode([
                "status" => false,
                "message" =>  "Không tìm thấy file",
            ]);
            exit();
        }

        $files = $_FILES["images"];
        $res = $this->productService->insert($product, $files);

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
        $product = $this->productService->getOne($id);
        $this->view("admin.product.show", [ "product" => $product]);
    }


    public function edit($id)
    {
        $product = $this->productService->getOne($id);

        $brandService = new BrandService();
        $brands = $brandService->getAll();

        $bodyShapeService = new BodyShapeService();
        $bodyShapes = $bodyShapeService->getAll();

        $categoryService = new CategoryService();
        $categories = $categoryService->getAll();

        $this->view("admin.product.edit", [ 
            "product" => $product,
            "brands" => $brands,
            "bodyShapes" => $bodyShapes,
            "categories" => $categories
        ]);
    }

    public function update($id)
    {
        session_start();
        $product = new Product();
        $product->product_id = $id;
        if(!isset($_POST["product_name"]) || empty($_POST["product_name"])) {
            $this->sendError("Thiếu tên sản phẩm");
        }
        $product->product_name = $_POST["product_name"];
        if(!isset($_POST["quantity"]) || empty($_POST["quantity"])) {
            $this->sendError("Thiếu số lượng");
        }
        $product->quantity = $_POST["quantity"];
        if(!isset($_POST["base_price"]) || empty($_POST["base_price"])) {
            $this->sendError("Thiếu giá");
        }
        $product->base_price = $_POST["base_price"];
        $product->price_unit = $_POST["price_unit"];
        $product->discount = $_POST["discount"];
        $product->discount_unit = $_POST["discount_unit"];
        if(!isset($_POST["number_of_string"]) || empty($_POST["number_of_string"])) {
            $this->sendError("Thiếu số lượng dây");
        }
        $product->number_of_string = $_POST["number_of_string"];
        if(!isset($_POST["brand_id"]) || empty($_POST["brand_id"])) {
            $this->sendError("Thiếu thương hiệu");
        }
        $product->brand_id = $_POST["brand_id"];
        if(!isset($_POST["category_id"]) || empty($_POST["category_id"])) {
            $this->sendError("Thiếu danh mục");
        }
        $product->category_id = $_POST["category_id"];
        if(!isset($_POST["body_shape_id"]) || empty($_POST["body_shape_id"])) {
            $this->sendError("Thiếu dáng đàn");
        }
        $product->body_shape_id = $_POST["body_shape_id"];
        if(!isset($_POST["description"]) || empty($_POST["description"])) {
            $this->sendError("Thiếu mô tả");
        }
        $product->description = $_POST["description"];
        if(!isset($_POST["body_material"]) || empty($_POST["body_material"])) {
            $this->sendError("Thiếu chất liệu thân đàn");
        }
        $product->body_material = $_POST["body_material"];
        if(!isset($_POST["fretboard_material"]) || empty($_POST["fretboard_material"])) {
            $this->sendError("Thiếu chất liệu cần đàn");
        }
        $product->fretboard_material = $_POST["fretboard_material"];
        if(!isset($_POST["scale_length"]) || empty($_POST["scale_length"])) {
            $this->sendError("Thiếu chiều dài dây");
        }
        $product->scale_length = $_POST["scale_length"];
        if(!isset($_POST["no_of_fret"]) || empty($_POST["no_of_fret"])) {
            $this->sendError("Thiếu số lượng phím");
        }
        $product->no_of_fret = $_POST["no_of_fret"];

        header('Content-Type: application/json');

        $files = [];
        if(count($_FILES) > 0) {
            $files = $_FILES["images"];
        }
        $order = json_decode($_POST["order"], true);
        $delete_images = json_decode($_POST["delete_images"], true);

        $res = $this->productService->update($product, $files, $order, $delete_images);

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
        session_start();
        $res = $this->productService->delete($id);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Xóa thành công": "Xóa thất bại",
        ];
        header('Content-Type: application/json');
        echo json_encode([]);
        exit();
    }

    public function sendError($message)
    {
        echo json_encode([
            "status" => false,
            "message" => $message,
        ]);
        exit();
    }
}