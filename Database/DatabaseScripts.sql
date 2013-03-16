DROP TABLE IF EXISTS users, prefix, order_item, orders, customer, product;


CREATE TABLE users (
    username VARCHAR(35),
    PASSWORD VARCHAR(250),
    PRIMARY KEY (username)
) ENGINE = INNODB;


CREATE TABLE prefix
(
  tableName VARCHAR(10),
  idPrefix VARCHAR(10),
  PRIMARY KEY (tableName)
) ENGINE = INNODB;
     
CREATE TABLE customer
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


CREATE TABLE product
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
   FOREIGN KEY (customer) REFERENCES customer (id)
)  ENGINE = INNODB;


CREATE TABLE order_item
(  order_id INT(10),
   prod_id  INT(12),
   qty      SMALLINT DEFAULT 1,
   FOREIGN KEY (order_id) REFERENCES orders (id), 
   FOREIGN KEY (prod_id)  REFERENCES product (id)
)  ENGINE = INNODB;


DELETE FROM order_item;
DELETE FROM orders;
DELETE FROM customer;
DELETE FROM product;
DELETE FROM prefix;

INSERT INTO prefix VALUES ("orders", "ord_");
INSERT INTO prefix VALUES ("customer", "cust_");
INSERT INTO prefix VALUES ("product", "prod_");

INSERT INTO users VALUES ("pwang@cs.kent.edu", "PASSWORD");
INSERT INTO users VALUES ("blacks@cs.kent.edu", "PASSWORD");
INSERT INTO users VALUES ("jdoe@cs.kent.edu", "PASSWORD");
INSERT INTO users VALUES ("mmoore@hotmail.com", "PASSWORD");


INSERT INTO customer VALUES (12001, "Wang", "Paul", "pwang@cs.kent.edu", "CS Dept.", "Kent", "OH", "44242", "0001");
INSERT INTO customer VALUES (12002, "Smith", "Black", "blacks@cs.kent.edu", "CS Dept.", "Kent", "OH", "44242", "0001");
INSERT INTO customer VALUES (12003, "Doe", "John", "jdoe@cs.kent.edu", "CS Dept.", "Kent", "OH", "44242", "0001");
INSERT INTO customer VALUES (12004, "Moore", "Mary", "mmoore@hotmail.com", "1234 Main St.", "Stow", "OH", "44224", "5436");

INSERT INTO product VALUES (99004, "Tennis Racquet", 95.85);
INSERT INTO product VALUES (99007, "Tennis Shoes", 75.95);
INSERT INTO product VALUES (99008, "Tennis Balls", 3.85);
INSERT INTO product VALUES (99009, "Tennis T-shirt", 15.85);

INSERT INTO orders VALUES (1009, 12001, CURRENT_DATE);
INSERT INTO orders VALUES (3039, 12002, "2012-01-17");
INSERT INTO orders VALUES (4049, 12003, "2012-03-27");
INSERT INTO orders VALUES (5059, 12004, "2012-8-22");

INSERT INTO order_item VALUES (1009, 99004, 1);
INSERT INTO order_item VALUES (1009, 99008, 4);
INSERT INTO order_item VALUES (1009, 99009, 1);
INSERT INTO order_item VALUES (4049, 99007, 1);