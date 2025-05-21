<?php 
require_once("Controller.php");

class HomeController extends Controller {

    public $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index() {
        $this->view("signup"); 
    }

    public function product($id) 
    {
        $product = $this->productService->getOne($id);
        $this->view("product", ["product" => $product]);
    }
}
