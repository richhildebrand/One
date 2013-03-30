DROP TABLE IF EXISTS order_items, products, orders, customers, users;


CREATE TABLE users (
    username VARCHAR(35),
    PASSWORD VARCHAR(250),
    PRIMARY KEY (username)
) ENGINE = INNODB;
     
CREATE TABLE customers
(  id INT(10) NOT NULL AUTO_INCREMENT,
   lastname VARCHAR(25),
   firstname VARCHAR(15),
   email VARCHAR(35),
   address VARCHAR(35),
   city VARCHAR(15),
   state CHAR(2),
   zip5 CHAR(5),
   zip4 CHAR(4),
   PRIMARY KEY (id),
   FOREIGN KEY (email) REFERENCES users (username)
)  ENGINE = INNODB;


CREATE TABLE products
(  id INT(12) NOT NULL AUTO_INCREMENT,
   description  VARCHAR(256),
   price DECIMAL(7,2),
   PRIMARY KEY (id)
)  ENGINE = INNODB;


CREATE TABLE orders
(  id INT(10) NOT NULL AUTO_INCREMENT,
   customer INT(10),
   order_date DATE NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (customer) REFERENCES customers (id)
)  ENGINE = INNODB;


CREATE TABLE order_items
(  order_id INT(10),
   prod_id  INT(12),
   qty      SMALLINT DEFAULT 1,
   FOREIGN KEY (order_id) REFERENCES orders (id), 
   FOREIGN KEY (prod_id)  REFERENCES products (id)
)  ENGINE = INNODB;


DELETE FROM order_items;
DELETE FROM orders;
DELETE FROM customers;
DELETE FROM products;