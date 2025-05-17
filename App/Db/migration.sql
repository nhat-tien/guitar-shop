CREATE DATABASE `guitar-shop`;

CREATE TABLE brands (
   brand_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   brand_name varchar(255)
);

CREATE TABLE categories (
   category_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   category_name varchar(255)
);

CREATE TABLE body_shape (
   body_shape_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   body_shape_name varchar(255)
);

CREATE TABLE products (
   product_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   product_name varchar(255),
   quantity int,
   base_price int,
   price_unit varchar(10),
   discount int,
   discount_unit varchar(10),
   number_of_string int,
   brand_id int,
   category_id int,
   body_shape_id int,
   description varchar(500),
   body_material varchar(255),
   fretboard_material varchar(255),
   scale_length varchar(255),
   no_of_fret int,
  FOREIGN KEY (brand_id) REFERENCES brands(brand_id),
  FOREIGN KEY (category_id) REFERENCES categories(category_id),
  FOREIGN KEY (body_shape_id) REFERENCES body_shape(body_shape_id)
);

CREATE TABLE product_images (
   product_image_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   product_id int,
   url varchar(255),
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE users (
  user_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_name varchar(255),
  user_email varchar(255) UNIQUE,
  password varchar(255),
  user_role varchar(100)
);

CREATE TABLE customers (
  customer_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  customer_name varchar(255),
  customer_email varchar(255) UNIQUE,
  address varchar(255),
  password varchar(255)
);

CREATE TABLE orders (
  order_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  customer_id varchar(255),
  address varchar(255),
  created_at datetime DEFAULT CURRENT_TIMESTAMP,
  updated_at datetime DEFAULT CURRENT_TIMESTAMP,
  total int
);

CREATE TABLE order_detail (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  order_id int,
  customer_id varchar(255),
  product_name varchar(255),
  product_quantity int,
  price int,
  created_at datetime DEFAULT CURRENT_TIMESTAMP,
  updated_at datetime DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (order_id) REFERENCES orders(order_id)
);