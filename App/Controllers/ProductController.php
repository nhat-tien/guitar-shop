<?php
require_once "Controller.php";

class ProductController extends Controller {

    public function index()
    {
        $this->view("admin.product.index");
    }

    public function create()
    {
        $this->view("admin.product.create");
    }


    public function store()
    {
        
    }

    public function show($id)
    {
        echo "Hello " . $id;
    }


    public function edit()
    {
        
    }

    public function update()
    {
        
    }


    public function destroy()
    {
        
    }
}