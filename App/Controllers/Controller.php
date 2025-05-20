<?php 


class Controller {

    protected function view($view, $data = []) {
        extract($data);
        $view = str_replace(".", "/", $view);
        include "App/Views/" . $view . ".php";
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