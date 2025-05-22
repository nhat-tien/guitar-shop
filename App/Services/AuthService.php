<?php

require_once "App/Db/Db.php";
require_once "App/Models/Customer.php";

class AuthService {

    public function loginCustomer(
        $email,
        $password
    )
    {
        $db = new Db();

        $statement = $db->statement("SELECT * FROM customers WHERE customer_email = :email")
        ->params([ 
            "email" => $email,
        ])
        ->className("Customer")
        ->query();

        $user = $statement->fetch();

        $db->close();

        if(empty($user)) {
            return null;
        }

        if(!password_verify($password, $user->password))
        {
            return null;
        }

        return $user;
    }
    public function loginAdmin(
        $email,
        $password
    )
    {
        $db = new Db();

        $statement = $db->statement("SELECT * FROM users WHERE user_email = :email")
        ->params([ 
            "email" => $email,
        ])
        ->className("User")
        ->query();

        $user = $statement->fetch();

        $db->close();

        if(empty($user)) {
            return null;
        }

        if(!password_verify($password, $user->password))
        {
            return null;
        }

        return $user;
    }

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