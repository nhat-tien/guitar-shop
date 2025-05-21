<?php
require_once "Controller.php";
require_once "App/Services/BodyShapeService.php";
require_once "App/Models/BodyShape.php";

class BodyShapeController extends Controller {

    private $bodyShapeService;

    public function __construct()
    {
       $this->bodyShapeService = new BodyShapeService();
    }

    public function index()
    {

        $body_shapes = $this->bodyShapeService->getAll();
        $this->view("admin.bodyShape.index", ["body_shapes" => $body_shapes]);
    }

    public function create()
    {
    }


    public function store()
    {
        $name = $_POST["body_shape_name"];
        $res = $this->bodyShapeService->insert($name);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Thêm thành công": "Thêm thất bại",
        ];
        header("location: /admin/body-shapes");
    }

    public function show($id)
    {

    }


    public function edit()
    {
        
    }

    public function update($id)
    {
        $name = $_POST['body_shape_name'];
        $body_shape = new BodyShape();
        $body_shape->body_shape_name = $name;
        $body_shape->body_shape_id = $id;
        $res = $this->bodyShapeService->update($body_shape);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Cập nhật thành công": "Cập nhật thất bại",
        ];
        header("location: /admin/body-shapes");
    }


    public function destroy($id)
    {
        $res = $this->bodyShapeService->delete($id);
        $_SESSION['response'] = [ 
            "status" => $res['status'],
            "message" => $res['status'] ? "Xóa thành công": "Xóa thất bại",
        ];
        header('Content-Type: application/json');
        echo json_encode([]);
        exit();
    }
}