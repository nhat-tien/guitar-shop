<?php
require_once "App/Models/Order.php";
require_once "App/Models/OrderDetail.php";

class OrderService {

    public function getAll() 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT * FROM orders")
        ->className("Order")
        ->query();

        $entities= $statemnt->fetchAll();

        $db->close();

        return $entities;
    }

    public function getOne($id) 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT
        *
        FROM orders o
        JOIN order_detail od
        ON o.order_id = od.order_id
        WHERE p.order_id = :order_id")
        ->className("Order")
        ->params([
            "order_id" => $id
        ])
        ->query();

        $entity = new Order();
        $model = $statemnt->fetch(PDO::FETCH_ASSOC);

        $entity->order_id = $model['order_id'];
        $entity->customer_id = $model['customer_id'];
        $entity->address = $model['address'];
        $entity->created_at = $model['created_at'];
        $entity->updated_at = $model['updated_at'];
        $entity->total = $model['total'];
        $entity->status = $model['status'];

        $order_detail = [];

        while($row = $statemnt->fetch(PDO::FETCH_ASSOC))
        {
            $detail = new OrderDetail();
            $detail->id = $row['id'];
            $detail->order_id = $row['order_id'];
            $detail->product_id = $row['product_id'];
            $detail->product_quantity = $row['product_quantity'];
            $detail->price = $row['price'];

            $order_detail[] = $detail;
        }

        $entity->order_detail = $order_detail;

        $db->close();

        return $entity;
    }

    public function insert($order, $order_detail)
    {
        $db = new Db();
        try {
        $db->beginTransation();
            $db->statement("INSERT INTO orders (
            customer_id,
            address,
            created_at,
            updated_at,
            total,
            status
            ) VALUES (
            :customer_id,
            :address,
            :created_at,
            :updated_at,
            :total,
            :status )") 
                ->params([
            "customer_id" => $order->customer_id,
            "address" => $order->address,
            "created_at" => $order->created_at,
            "updated_at" => $order->updated_at,
            "total" => $order->total,
            "status" => $order->status
            ])
            ->execute();
            
            $orderId = $db->lastId();
            foreach($order_detail as $detail)
            {
                $db->statement("INSERT INTO order_detail (
                    order_id,
                    product_id,
                    product_quantity,
                    price,
                ) VALUES (
                    :order_id,
                    :product_id,
                    :product_quantity,
                    :price,
                )")
                ->params([
                    "order_id" => $orderId,
                    "product_id" => $detail->product_id,
                    "product_quantity" => $detail->product_quantity,
                    "price" => $detail->price,
                ]) 
                ->execute();
            }

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

    public function delete($id)
    {
        $db = new Db();
        try {
            $db->beginTransation();

            $db->statement("DELETE FROM order_detail WHERE order_id = :order_id")
            ->params(["order_id" => $id])
            ->execute();

            $db->statement("DELETE FROM orders WHERE order_id = :order_id")
            ->params(["order_id" => $id])
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

    public function update($product, $file, $order, $delete_images)
    {
        $db = new Db();
        try {
        $db->beginTransation();
            $db->statement("UPDATE products SET 
            product_name = :product_name,
            quantity = :quantity,
            base_price = :base_price,
            price_unit = :price_unit,
            discount = :discount,
            discount_unit = :discount_unit,
            number_of_string = :number_of_string,
            brand_id = :brand_id,
            category_id = :category_id,
            body_shape_id = :body_shape_id,
            description = :description,
            body_material = :body_material,
            fretboard_material = :fretboard_material,
            scale_length = :scale_length,
            no_of_fret = :no_of_fret
            WHERE 
            product_id = :product_id")
                ->params([
                "product_id" => (int) $product->product_id,
                "product_name" => $product->product_name,
                "quantity" => (int) $product->quantity,
                "base_price" =>(int) $product->base_price,
                "price_unit" => $product->price_unit,
                "discount" => (int) $product->discount,
                "discount_unit" => $product->discount_unit,
                "number_of_string" =>(int) $product->number_of_string,
                "brand_id" => (int) $product->brand_id,
                "category_id" => (int) $product->category_id,
                "body_shape_id" => (int) $product->body_shape_id,
                "description" => $product->description,
                "body_material" => $product->body_material,
                "fretboard_material" => $product->fretboard_material,
                "scale_length" => $product->scale_length,
                "no_of_fret" => (int) $product->no_of_fret,
            ])
            ->execute();
            
            foreach($delete_images as $delete_image)
            {
                $db->statement("DELETE FROM product_images WHERE product_image_id = :product_image_id")
                ->params(["product_image_id" => $delete_image["id"]])
                ->execute();

                $base_path = __DIR__ .  "/../..";

                if (file_exists($base_path . $delete_image->url)) {
                    unlink($base_path . $delete_image->url);
                }
            }

            $indexInFile = 0;

            foreach($order as $index => $image) {

                if($image["action"] == "stay") 
                {
                    $db->statement("UPDATE product_images SET 
                    order_image = :order_image,
                    WHERE 
                    product_image_id = :product_image_id")
                        ->params([
                        "product_image_id" => $image['id'],
                        "order_image" => $index + 1,
                    ])
                    ->execute();

                } elseif ($image["action"] == "add") {
                    $name     = $file['name'][$indexInFile];
                    $type     = $file['type'][$indexInFile];
                    $tmpName  = $file['tmp_name'][$indexInFile];
                    $error    = $file['error'][$indexInFile];
                    $size     = $file['size'][$indexInFile];

                    if ($error === UPLOAD_ERR_OK) {
                        $file_path = __DIR__ .  "/../../public/uploads/" . time() . basename($name);
                        move_uploaded_file($tmpName, $file_path);
                        $db->statement("INSERT INTO product_images (
                            product_id,
                            product_image_name,
                            url,
                            order_image
                        ) VALUES (
                            :product_id,
                            :product_image_name,
                            :url,
                            :order_image
                        )")
                        ->params([
                            "product_id" => $product->product_id,
                            "product_image_name" => basename($name),
                            "url" => "/public/uploads/" . time() . basename($name),
                            "order_image" => $index + 1
                        ]) 
                        ->execute();
                    }
                    $indexInFile++;
                }
            }


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
