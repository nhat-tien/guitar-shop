<?php 


class Controller {
    protected function view($view, $data = []) {
        extract($data);
        include "App/Views/" . $view . ".php";
    }
}