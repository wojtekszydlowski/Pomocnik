<?php
# Wyniki z dwóch (lub więcej) tabel naraz możemy uzyskać dzięki użyciu wyrażenia kluczowego JOIN ... ON ....
# SELECT column_name(s) FROM table1 JOIN table2 ON table1.column_name=table2.column_name;

# Załóżmy, że mamy dwie tabele:
/*

CREATE TABLE customers(
    customer_id int NOT NULL AUTO_INCREMENT,
name varchar(255) NOT NULL,
PRIMARY KEY(customer_id)
);
CREATE TABLE addresses(
    address_id int NOT NULL AUTO_INCREMENT,
customer_id int,
street varchar(255),
PRIMARY KEY(address_id)
);

*/

# INNER JOIN (lub zwykłe JOIN) jest podstawowym typem łączenia tabel. Jako wynik daje on tylko wiersze, które spełniają podany warunek (część wspólną obu tabel).
# SELECT * FROM customers JOIN addresses ON customers.customer_id=addresses.customer_id;

/*

INSERT INTO customers(name) VALUES ("Janusz"), ("Kuba"), ("Wojtek");
INSERT INTO addresses(customer_id, street) VALUES (1, "Ulica Janusza"), (2, "Ulica Kuby");

SELECT * FROM customers JOIN addresses ON
customers.customer_id=addresses.customer_id
WHERE customers.customer_id=2;

 */

# LEFT JOIN zwraca jako wynik wszystkie wiersze z lewej tabeli. Dane z prawej tabeli zostaną dołączone tylko w rzędach spełniających warunek.
# SELECT * FROM customers LEFT JOIN addresses ON customers.customer_id=addresses.customer_id;



# RIGHT JOIN zwraca jako wynik wszystkie wiersze z prawej tabeli. Dane z prawej zostaną dołączone tylko w rzędach spełniających warunek.
# SELECT * FROM customers RIGHT JOIN addresses ON customers.customer_id=addresses.customer_id;

