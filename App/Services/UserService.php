<?php
require_once "App/Models/User.php";

class UserService {

    public function getAll() 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT * FROM users")
        ->className("User")
        ->query();

        $entities = $statemnt->fetchAll();

        $db->close();

        return $entities;
    }

    public function getOne($id) 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT * FROM users WHERE user_id = :user_id")
        ->className("User")
        ->params([ "user_id" => (int) $id])
        ->query();

        $entity = $statemnt->fetch();

        $db->close();

        return $entity;
    }

    public function insert($user)
    {
        $password = password_hash($user->password, PASSWORD_DEFAULT);

        Db::builder()
        ->statement("INSERT INTO users (
            user_name,
            user_email,
            address,
            password
        ) VALUES (
            :user_name,
            :user_email,
            :address,
            :password
        )")
        ->params([
            "user_name" => $user->user_name,
            "user_email" => $user->user_email,
            "address" => $user->address,
            "password" => $password,
        ])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }

    public function delete($id)
    {
        Db::builder()
        ->statement("DELETE FROM users WHERE user_id = :user_id")
        ->params(["user_id" => $id])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }

    public function update($user)
    {
        if(empty($password)) {
            Db::builder()
            ->statement("UPDATE users SET
                user_name = :user_name,
                user_email = :user_email,
                address = :address,
                WHERE user_id = :user_id
            ")
            ->params([
                "user_name" => $user->user_name,
                "user_email" => $user->user_email,
                "address" => $user->address,
                "user_id" => (int) $user->user_id
            ])
            ->execute()
            ->close();
        } else {
            $password = hash("sha256", $user->password);

            Db::builder()
            ->statement("UPDATE users SET
                user_name = :user_name,
                user_email = :user_email,
                address = :address,
                password = :password
                WHERE user_id = :user_id
            ")
            ->params([
                "user_name" => $user->user_name,
                "user_email" => $user->user_email,
                "address" => $user->address,
                "password" => $password,
                "user_id" => (int) $user->user_id
            ])
            ->execute()
            ->close();
        }

        return [
            "status" => true
        ];
    }
}
