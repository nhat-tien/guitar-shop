<?php
require_once "App/Models/Product.php";
require_once "App/Models/ProductImage.php";

class ProductService {

    public function getAll() 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT 
        p.product_id AS product_id,
        p.product_name AS product_name,
        p.*,  
        pi.product_image_id,
        pi.product_image_name,
        pi.url,
        pi.order_image,
        bnd.brand_name AS brand_name,
        c.category_name AS category_name,
        bd.body_shape_name AS body_shape_name
        FROM products p 
        LEFT JOIN product_images pi
        ON pi.product_id = p.product_id
        JOIN brands bnd
        ON bnd.brand_id = p.brand_id
        JOIN categories c 
        ON c.category_id = p.category_id
        JOIN body_shape bd
        ON bd.body_shape_id = p.body_shape_id
        ORDER BY p.product_id ASC, pi.order_image ASC")
        ->className("Product")
        ->query();

        $rows = $statemnt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];

        foreach($rows as $row)
        {
            $pid = $row['product_id'];
            if (!isset($products[$pid])) {
                $entity = new Product();
                $entity->product_id = $row['product_id'];
                $entity->product_name = $row['product_name'];
                $entity->quantity = $row['quantity'];
                $entity->base_price = $row['base_price'];
                $entity->discount = $row['discount'];
                $entity->discount_unit = $row['discount_unit'];
                $entity->number_of_string = $row['number_of_string'];
                $entity->brand_id = $row['brand_id'];
                $entity->brand_name = $row['brand_name'];
                $entity->category_id = $row['category_id'];
                $entity->category_name = $row['category_name'];
                $entity->body_shape_id = $row['body_shape_id'];
                $entity->body_shape_name = $row['body_shape_name'];
                $entity->description = $row['description'];
                $entity->body_material = $row['body_material'];
                $entity->fretboard_material = $row['fretboard_material'];
                $entity->scale_length = $row['scale_length'];
                $entity->no_of_fret = $row['no_of_fret'];
                $products[$pid] = $entity;
            }

            if ($row['product_image_id']) {
                $image = new ProductImage();
                $image->product_image_id = $row['product_image_id'];
                $image->product_image_name = $row['product_image_name'];
                $image->product_id = $row['product_id'];
                $image->url = $row['url'];
                $image->order_image = $row['order_image'];
                $products[$pid]->images[] = $image;
            }
        }

        $entities = array_values($products);

        $db->close();

        return $entities;
    }

    public function getOne($id) 
    {
        $db = new Db();
        $statemnt = $db
        ->statement("SELECT
        p.product_id AS product_id,
        p.product_name AS product_name,
        p.*,  
        pi.product_image_id,
        pi.product_image_name,
        pi.url,
        pi.order_image,
        bnd.brand_name AS brand_name,
        c.category_name AS category_name,
        bd.body_shape_name AS body_shape_name
        FROM products p 
        JOIN brands bnd
        ON bnd.brand_id = p.brand_id
        JOIN categories c 
        ON c.category_id = p.category_id
        JOIN body_shape bd
        ON bd.body_shape_id = p.body_shape_id
        LEFT JOIN product_images pi
        ON pi.product_id = p.product_id
        WHERE p.product_id = :product_id
        ORDER BY pi.order_image ASC")
        ->className("Product")
        ->params([
            "product_id" => $id
        ])
        ->query();
        $entity = new Product();

        $model = $statemnt->fetch(PDO::FETCH_ASSOC);
        $entity->product_id = $model['product_id'];
        $entity->product_name = $model['product_name'];
        $entity->quantity = $model['quantity'];
        $entity->base_price = $model['base_price'];
        $entity->discount = $model['discount'];
        $entity->discount_unit = $model['discount_unit'];
        $entity->number_of_string = $model['number_of_string'];
        $entity->brand_id = $model['brand_id'];
        $entity->brand_name = $model['brand_name'];
        $entity->category_id = $model['category_id'];
        $entity->category_name = $model['category_name'];
        $entity->body_shape_id = $model['body_shape_id'];
        $entity->body_shape_name = $model['body_shape_name'];
        $entity->description = $model['description'];
        $entity->body_material = $model['body_material'];
        $entity->fretboard_material = $model['fretboard_material'];
        $entity->scale_length = $model['scale_length'];
        $entity->no_of_fret = $model['no_of_fret'];

        $images = [];

        if($model["product_image_id"]) {
            $image = new ProductImage();
            $image->product_image_id = $model['product_image_id'];
            $image->product_image_name = $model['product_image_name'];
            $image->product_id = $model['product_id'];
            $image->url = $model['url'];
            $image->order_image = $model['order_image'];
            $images[] = $image;
        }

        while($row = $statemnt->fetch(PDO::FETCH_ASSOC))
        {
            $image = new ProductImage();
            $image->product_image_id = $row['product_image_id'];
            $image->product_image_name = $row['product_image_name'];
            $image->product_id = $row['product_id'];
            $image->url = $row['url'];
            $image->order_image = $row['order_image'];
            $images[] = $image;
        }

        $entity->images = $images;
        $db->close();
        return $entity;
    }

    public function insert($product, $images)
    {
        $db = new Db();
        try {
        $db->beginTransation();

            $db->statement("INSERT INTO products (
            product_name,
            quantity,
            base_price,
            discount,
            discount_unit,
            number_of_string,
            brand_id,
            category_id,
            body_shape_id,
            description,
            body_material,
            fretboard_material,
            scale_length,
            no_of_fret
            ) VALUES (
            :product_name,
            :quantity,
            :base_price,
            :discount,
            :discount_unit,
            :number_of_string,
            :brand_id,
            :category_id,
            :body_shape_id,
            :description,
            :body_material,
            :fretboard_material,
            :scale_length,
            :no_of_fret )") 
                ->params([
                "product_name" => $product->product_name,
                "quantity" => (int) $product->quantity,
                "base_price" =>(int) $product->base_price,
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
            
            $productId = $db->lastId();
            $fileCount = count($images['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                $name     = $images['name'][$i];
                $type     = $images['type'][$i];
                $tmpName  = $images['tmp_name'][$i];
                $error    = $images['error'][$i];
                $size     = $images['size'][$i];

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
                        "product_id" => $productId,
                        "product_image_name" => basename($name),
                        "url" => "/public/uploads/" . time() . basename($name),
                        "order_image" => $i + 1
                    ]) 
                    ->execute();
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

    public function delete($id)
    {
        $db = new Db();
        try {
            $db->beginTransation();

            $images = $db->statement("SELECT * FROM product_images WHERE product_id = :product_id")
            ->params(["product_id" => $id])
            ->className("ProductImage")
            ->query()
            ->fetchAll();

            $db->statement("DELETE FROM product_images WHERE product_id = :product_id")
            ->params(["product_id" => $id])
            ->execute();

            $base_path = __DIR__ .  "/../..";

            foreach($images as $image) 
            {
                if (file_exists($base_path . $image->url)) {
                    unlink($base_path . $image->url);
                }
            }

            $db->statement("DELETE FROM products WHERE product_id = :product_id")
            ->params(["product_id" => $id])
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
