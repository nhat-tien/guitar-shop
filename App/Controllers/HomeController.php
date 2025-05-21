<?php 
require_once("Controller.php");

class HomeController extends Controller {

    public function index() {
        $this->view("cart");
    public $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }   

    public function index() 
    {
        $this->view("home");
    }

    public function product($id) 
    {
        $product = $this->productService->getOne($id);
        $this->view("product", ["product" => $product]);
    }
}