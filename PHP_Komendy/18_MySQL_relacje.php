<?php
# RELACJA JEDEN DO JEDNEGO

/*
Relacja, w której jeden element z danej tabeli może być połączony tylko z jednym elementem z innej tabeli. Klient może mieć tylko jeden adres.
Adres musi mieć jednego klienta.

Relację jeden do jednego tworzymy przez uzależnienie klucza głównego wpisu od klucza głównego drugiego obiektu. Klucz główny nie może istnieć bez tej relacji. W naszym przypadku będzie to wpisywanie klucza głównego klienta jako klucza głównego adresu.

CREATE TABLE customers(
customer_id int NOT NULL AUTO_INCREMENT,
name varchar(255) NOT NULL,
PRIMARY KEY(customer_id)
);

CREATE TABLE addresses(
customer_id int NOT NULL,
street varchar(255),
PRIMARY KEY(customer_id),
FOREIGN KEY(customer_id) REFERENCES customers(customer_id)
ON DELETE CASCADE
);

# ON DELETE CASCADE - jest opcjonalnym parametrem. Nie musi go być. Jeśli skasujemy coś w tabeli 1 to zostanie to skasowane również w tabeli 2. Opcja ta powoduje że usunięcie rzędu w tabelce automatycznie spowoduje usunięcie wszystkich rzędów w innych tabelkach które są z nim połączone jakąś relacją.
Np. Jeżeli usuwamy użytkownika to chcemy żeby wszystkie jego wiadomości w systemie zostały wyrzucone razem z nim.

Jeżeli nie dodamy tej opcji to SQL nie pozwoli nam usunąć rzędu dopóki są z nim powiązane jakiekolwiek wpisy w innych tabelkach.
Np. SQL nie pozwoli nam usunąć użytkownika dopóki w tabelce z wiadomościami znajdują się rzędy przypisane do niego.


# Atrybut FOREIGN KEY dopisany do jakiejś kolumny mówi po prostu, że ta kolumna wskazuje na klucz główny innej tabelki.
 */

# Przykład relacji jeden do jednego - Tabela ClientAddress ma być połączona relacją jeden do jednego z tabelą Clients.:

$tableAddQuery = 'CREATE TABLE ClientAddress (
     client_id INT NOT NULL,
     city VARCHAR (128),
     street VARCHAR (128),
     house_nr VARCHAR (16),
     PRIMARY KEY (client_id),
     FOREIGN KEY (client_id) REFERENCES Clients(id) ON DELETE CASCADE 
)
';



# ----------------------------


# RELACJA JEDEN DO WIELU

/*
Relacja, w której jeden element z danej tabeli, może być połączony z wieloma elementami z innej tabeli.
Klient może mieć wiele zamówień. Zamówienie musi mieć tylko jednego klienta.

Relację jeden do wielu tworzymy przez dodanie dodatkowej kolumny, w której trzymamy klucz główny obiektu z drugiej tabeli.

CREATE TABLE orders(
order_id int NOT NULL AUTO_INCREMENT,
customer_id int NOT NULL,
order_details varchar(255),
PRIMARY KEY(order_id),
FOREIGN KEY(customer_id)
REFERENCES customers(customer_id)
);


INSERT INTO orders(customer_id, order_details) VALUES (3, "Zamowienie1"), (3, "Zamowienie2"), (1, "Zamowienie3");

SELECT * FROM customers JOIN orders ON customers.customer_id=orders.c
 */



# ----------------------------


# RELACJA WIELE DO WIELU

/*
Relacja, w której wiele elementów z danej tabeli może być połączonych z wieloma elementami z innej tabeli.
Na przykład zamówienie ma w sobie wiele przedmiotów, przedmiot może być w wielu zamówieniach.

W SQL nie da się zrobić czegoś takiego jak relacja wiele do wielu. Relację wiele do wielu tworzymy przez dodanie dodatkowej tabeli, która
opisuje nam taką relację i która posiada dwie relacje jeden do wielu.
Tabela ta może trzymać więcej informacji niż tylko kucze główne swoich relacji.

CREATE TABLE items(
item_id int NOT NULL AUTO_INCREMENT,
description varchar(255),
PRIMARY KEY(item_id)
);

INSERT INTO items(description) VALUES ("Item 1"), ("Item 2"), ("Items 3");

CREATE TABLE items_orders(
id int AUTO_INCREMENT,
item_id int NOT NULL,
order_id int NOT NULL,
PRIMARY KEY(id),
FOREIGN KEY(order_id) REFERENCES orders(order_id),
FOREIGN KEY(item_id) REFERENCES items(item_id)
);

INSERT INTO items_orders(order_id, item_id) VALUES (1,1), (2,1), (2,2);

SELECT * FROM orders
JOIN items_orders ON orders.order_id=items_orders.order_id;
JOIN items ON items.item_id=items_orders.item_id;
 */