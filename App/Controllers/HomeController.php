<?php 
require_once("Controller.php");

class HomeController extends Controller {

    public $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index() {
        $this->view("home"); 
    }

    public function collection() {
        $this->view("collection"); 
    }

    public function cart() {
        $this->view("cart"); 
    }

    public function product($id) 
    {
        $product = $this->productService->getOne($id);
        $this->view("product", ["product" => $product]);
    }
}
