drop table IF EXISTS users, order_item, orders, customer, product;# MySQL returned an empty result set (i.e. zero rows).


CREATE TABLE users (
    username VARCHAR(35),
    password VARCHAR(250),
    PRIMARY KEY (username)
) ENGINE = InnoDB;# MySQL returned an empty result set (i.e. zero rows).

	   
CREATE TABLE customer
(  id VARCHAR(10),
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
)  ENGINE = InnoDB;# MySQL returned an empty result set (i.e. zero rows).


CREATE TABLE product
(  id VARCHAR(12),
   description  VARCHAR(256),
   price DECIMAL(7,2),
   PRIMARY KEY (id)
)  ENGINE = InnoDB;# MySQL returned an empty result set (i.e. zero rows).



CREATE TABLE orders
(  id       VARCHAR(10),
   customer VARCHAR(10),
   order_date DATE NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (customer) REFERENCES customer (id)
)  ENGINE = InnoDB;# MySQL returned an empty result set (i.e. zero rows).


CREATE TABLE order_item
(  order_id VARCHAR(10),
   prod_id  VARCHAR(12),
   qty      SMALLINT DEFAULT 1,
   FOREIGN KEY (order_id) REFERENCES orders (id) 
      ON DELETE CASCADE ON UPDATE CASCADE,
   FOREIGN KEY (prod_id)  REFERENCES product (id),
   PRIMARY KEY (order_id, prod_id)
)  ENGINE = InnoDB;# MySQL returned an empty result set (i.e. zero rows).


DELETE FROM order_item;# MySQL returned an empty result set (i.e. zero rows).

DELETE FROM orders;# MySQL returned an empty result set (i.e. zero rows).

DELETE FROM customer;# MySQL returned an empty result set (i.e. zero rows).

DELETE FROM product;# MySQL returned an empty result set (i.e. zero rows).


INSERT INTO users values ("pwang@cs.kent.edu", password);# 1 row affected.

INSERT INTO users values ("blacks@cs.kent.edu", password);# 1 row affected.

INSERT INTO users values ("jdoe@cs.kent.edu", password);# 1 row affected.

INSERT INTO users values ("mmoore@hotmail.com", password);# 1 row affected.


INSERT INTO customer values ("cus_12001", "Wang", "Paul", "pwang@cs.kent.edu", "CS Dept.", "Kent", "OH", "44242", "0001");# 1 row affected.

INSERT INTO customer values ("cus_12002", "Smith", "Black", "blacks@cs.kent.edu", "CS Dept.", "Kent", "OH", "44242", "0001");# 1 row affected.

INSERT INTO customer values ("cus_12003", "Doe", "John", "jdoe@cs.kent.edu", "CS Dept.", "Kent", "OH", "44242", "0001");# 1 row affected.

INSERT INTO customer values ("cus_12004", "Moore", "Mary", "mmoore@hotmail.com", "1234 Main St.", "Stow", "OH", "44224", "5436");# 1 row affected.


INSERT INTO product values ("prod_99004", "Tennis Racquet", 95.85);# 1 row affected.

INSERT INTO product values ("prod_99007", "Tennis Shoes", 75.95);# 1 row affected.

INSERT INTO product values ("prod_99008", "Tennis Balls", 3.85);# 1 row affected.

INSERT INTO product values ("prod_99009", "Tennis T-shirt", 15.85);# 1 row affected.


INSERT INTO orders values ("ord_01009", "cus_12001", CURRENT_DATE);# 1 row affected.

INSERT INTO orders values ("ord_03039", "cus_12002", "2012-01-17");# 1 row affected.

INSERT INTO orders values ("ord_04049", "cus_12003", "2012-03-27");# 1 row affected.

INSERT INTO orders values ("ord_05059", "cus_12004", "2012-8-22");# 1 row affected.


INSERT INTO order_item values ("ord_01009", "prod_99004", 1);# 1 row affected.

INSERT INTO order_item values ("ord_01009", "prod_99008", 4);# 1 row affected.

INSERT INTO order_item values ("ord_01009", "prod_99009", 1);# 1 row affected.

INSERT INTO order_item values ("ord_04049", "prod_99007", 1);# 1 row affected.
