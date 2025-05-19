<?php
require_once "App/Models/Category.php";

class CategoryService {

    public function getAll() 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT * FROM categories")
        ->className("Category")
        ->query();

        $entities = $statemnt->fetchAll();

        $db->close();

        return $entities;
    }

    public function insert($category_name)
    {
        Db::builder()
        ->statement("INSERT INTO categories (category_name) VALUES (:category_name)")
        ->params(["category_name" => $category_name])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }

    public function delete($id)
    {
        Db::builder()
        ->statement("DELETE FROM categories WHERE category_id = :category_id")
        ->params(["category_id" => $id])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }

    public function update($category)
    {
        Db::builder()
        ->statement("UPDATE categories SET category_name = :category_name WHERE category_id = :category_id")
        ->params([
            "category_id" => $category->category_id,
            "category_name" => $category->category_name
        ])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }
}