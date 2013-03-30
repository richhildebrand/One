DROP TABLE IF EXISTS pizza_crusts, crusts, toppings, pizza_toppings, pizzas, orders, customers, users;


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


CREATE TABLE toppings
(  id INT(12) NOT NULL AUTO_INCREMENT,
   description  VARCHAR(256),
   price DECIMAL(7,2),
   PRIMARY KEY (id)
)  ENGINE = INNODB;

CREATE TABLE crusts
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

CREATE TABLE pizzas
(  id INT(10) NOT NULL AUTO_INCREMENT,
   order_id INT(10),
   quantity INT(10),
   PRIMARY KEY (id),
   FOREIGN KEY (order_id) REFERENCES orders (id)
)  ENGINE = INNODB;


CREATE TABLE pizza_toppings
(  pizza_id INT(10),
   topping_id  INT(12),
   FOREIGN KEY (pizza_id) REFERENCES pizzas (id), 
   FOREIGN KEY (topping_id)  REFERENCES toppings (id)
)  ENGINE = INNODB;

CREATE TABLE pizza_crusts
(  pizza_id INT(10),
   crust_id  INT(12),
   FOREIGN KEY (pizza_id) REFERENCES pizzas (id), 
   FOREIGN KEY (crust_id)  REFERENCES crusts (id)
)  ENGINE = INNODB;


DELETE FROM pizza_crusts;
DELETE FROM crusts;

DELETE FROM pizza_toppings;
DELETE FROM toppings;

DELETE FROM pizzas;
DELETE FROM orders;
DELETE FROM customers;
DELETE FROM users;

INSERT INTO toppings(description, price) VALUES ('onions', 2);
INSERT INTO toppings(description, price) VALUES ('peppers', 3);
INSERT INTO toppings(description, price) VALUES ('mushrooms', 4);