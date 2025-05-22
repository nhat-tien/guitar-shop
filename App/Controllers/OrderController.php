<?php
require_once "Controller.php";
require_once "App/Services/OrderService.php";

class OrderController extends Controller {


    public $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }

    public function index()
    {
        $orders = $this->orderService->getAll();
        $this->view("admin.order.index", ["orders" => $orders]);
    }

    public function create()
    {
    }


    public function store()
    {
        if(!isset($_POST["cart"]) || empty($_POST["cart"])) {
            $this->sendError("Không nhận được đơn hàng");
        }
        $cart = json_decode($_POST["cart"], true);
    }

    public function show($id)
    {
        $order = $this->orderService->getOne($id);
        $this->view("admin.order.show", ["orders" => $order]);
    }


    public function edit($id)
    {
    }

    public function update($id)
    {
    }


    public function destroy($id)
    {
    }

}

