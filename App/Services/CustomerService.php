<?php
require_once "App/Models/Customer.php";

class CustomerService {

    public function getAll() 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT * FROM customers")
        ->className("Customer")
        ->query();

        $entities = $statemnt->fetchAll();

        $db->close();

        return $entities;
    }

    public function getOne($id) 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT * FROM customers WHERE customer_id = :customer_id")
        ->className("Customer")
        ->params([ "customer_id" => (int) $id])
        ->query();

        $entity = $statemnt->fetch();

        $db->close();

        return $entity;
    }

    public function insert($customer)
    {
        $password = hash("sha256", $customer->password);

        Db::builder()
        ->statement("INSERT INTO customers (
            customer_name,
            customer_email,
            address,
            password
        ) VALUES (
            :customer_name,
            :customer_email,
            :address,
            :password
        )")
        ->params([
            "customer_name" => $customer->customer_name,
            "customer_email" => $customer->customer_email,
            "address" => $customer->address,
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
        ->statement("DELETE FROM customers WHERE customer_id = :customer_id")
        ->params(["customer_id" => $id])
        ->execute()
        ->close();

        return [
            "status" => true
        ];
    }

    public function update($customer)
    {
        if(empty($password)) {
            Db::builder()
            ->statement("UPDATE customers SET
                customer_name = :customer_name,
                customer_email = :customer_email,
                address = :address,
                WHERE customer_id = :customer_id
            ")
            ->params([
                "customer_name" => $customer->customer_name,
                "customer_email" => $customer->customer_email,
                "address" => $customer->address,
                "customer_id" => (int) $customer->customer_id
            ])
            ->execute()
            ->close();
        } else {
            $password = hash("sha256", $customer->password);

            Db::builder()
            ->statement("UPDATE customers SET
                customer_name = :customer_name,
                customer_email = :customer_email,
                address = :address,
                password = :password
                WHERE customer_id = :customer_id
            ")
            ->params([
                "customer_name" => $customer->customer_name,
                "customer_email" => $customer->customer_email,
                "address" => $customer->address,
                "password" => $password,
                "customer_id" => (int) $customer->customer_id
            ])
            ->execute()
            ->close();
        }

        return [
            "status" => true
        ];
    }
}
