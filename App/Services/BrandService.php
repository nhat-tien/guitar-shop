<?php
require_once "App/Models/Brand.php";

class BrandService {

    public function getAll() 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT * FROM brands")
        ->className("Brand")
        ->query();

        $entities = $statemnt->fetchAll();

        $db->close();

        return $entities;
    }

    public function insert($brand_name)
    {
        Db::builder()
        ->statement("INSERT INTO brands (brand_name) VALUES (:brand_name)")
        ->params(["brand_name" => $brand_name])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }

    public function delete($id)
    {
        Db::builder()
        ->statement("DELETE FROM brands WHERE brand_id = :brand_id")
        ->params(["brand_id" => $id])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }

    public function update($brand)
    {
        Db::builder()
        ->statement("UPDATE brands SET brand_name = :brand_name WHERE brand_id = :brand_id")
        ->params([
            "brand_id" => $brand->brand_id,
            "brand_name" => $brand->brand_name
        ])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }
}