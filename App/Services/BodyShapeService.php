<?php
require_once "App/Models/BodyShape.php";

class BodyShapeService {

    public function getAll() 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT * FROM body_shape")
        ->className("BodyShape")
        ->query();

        $entities = $statemnt->fetchAll();

        $db->close();

        return $entities;
    }

    public function insert($body_shape_name)
    {
        Db::builder()
        ->statement("INSERT INTO body_shape (body_shape_name) VALUES (:body_shape_name)")
        ->params(["body_shape_name" => $body_shape_name])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }

    public function delete($id)
    {
        Db::builder()
        ->statement("DELETE FROM body_shape WHERE body_shape_id = :body_shape_id")
        ->params(["body_shape_id" => $id])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }

    public function update($body_shape)
    {
        Db::builder()
        ->statement("UPDATE body_shape SET body_shape_name = :body_shape_name WHERE body_shape_id = :body_shape_id")
        ->params([
            "body_shape_id" => $body_shape->body_shape_id,
            "body_shape_name" => $body_shape->body_shape_name
        ])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }
}