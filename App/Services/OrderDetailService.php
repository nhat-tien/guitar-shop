<?php

class OrderDetailService {

    public function delete($id)
    {
        $db = new Db();
        try {
            $db->beginTransation();

            $db->statement("DELETE FROM order_detail WHERE id = :id")
            ->params(["id" => $id])
            ->execute();

            $db->commit();

            return [
                "status" => true
            ];
        } catch(Exception $e)
        {
            $db->rollback();
            return [
                "status" => false ,
                "message" => $e->__toString()
            ];
        } finally {
            $db->close();
        }
    }

    public function update($order_detail)
    {
        $db = new Db();
        try {
        $db->beginTransation();

            $db->statement("UPDATE order_detail SET 
            product_quantity = :product_quantity,
            price = :price
            WHERE 
            id = :id")
            ->params([
                "product_quantity" => $order_detail->product_quantity,
                "price" => $order_detail->price,
                "id" => $order_detail->id
            ])
            ->execute();

            $db->commit();

        return [
            "status" => true
        ];
    } catch(Exception $e) {
        $db->rollback();
        return [
            "status" => false ,
            "message" => $e->__toString()
        ];
    } finally {
        $db->close();
    }
    }
}