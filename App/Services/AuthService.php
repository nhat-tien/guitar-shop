<?php

require_once("App/Db/Db.php");

class AuthService {

    public function registerUser(
        $name,
        $email,
        $password
    )
    {
        $db = new Db();

        $password = hash("sha256", $password);

        $db->statement("INSERT INTO users (user_name, user_email, password) VALUES (:name, :email, :password)")
        ->params([ 
            "name" => $name, 
            "email" => $email,
            "password" => $password])
        ->execute()
        ->close();
    }
}