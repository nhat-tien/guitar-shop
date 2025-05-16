<?php 


class Controller {
    protected function view($view, $data = []) {
        extract($data);
        $view = str_replace(".", "/", $view);
        include "App/Views/" . $view . ".php";
    }
}