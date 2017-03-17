<?php
# Zadanie 1 - Stwórz nową bazę danych o nazwie products_ex. Następnie napisz skrypt PHP, który stworzy połączenie do tej bazy danych.

//Zapisz w poniższej zmiennej kod zapytania SQL
$query = 'CREATE DATABASE products_ex';

//Stwórz poniżej odpowiednie zmienne z danymi do bazy
$server = '127.0.0.1'; //== localhost  localhost == 127.0.0.1
$username = 'root';
$password = 'coderslab';
$dbname = 'products_ex';

//Poniżej napisz kod łączący się z bazą danych
$conn = new mysqli($server,$username,$password,$dbname);

if ($conn->connect_error) {
    die ('Coś się popsuło...' . $conn->connect_error);
    //Tutaj nigdy nie dojdzie.
    //Nic dalej się nie wykona, nigdy.
}
else
{echo 'Udało się połączyć...<br>';
}
$conn->close();


# --------------------------------------


/*
 *
 * Zadanie 2 - W bazie danych o nazwie products_ex stwórz następujące tabele:

* Products:
  * id: int
  * name: string
  * description: string
  * price: decimal (2 decimal places)
* Orders:
  * id:int
  * description: string
* Clients:
  * id: int
  * name: string
  * surname: string
 */


//Zapisz w poniższej zmiennej kod zapytania SQL tworzącego pierwszą tabelę
$queryCreateTable1 = '
CREATE TABLE Products
(
  id INT AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(8, 2),
  PRIMARY KEY(id)
)
';

//Zapisz w poniższej zmiennej kod zapytania SQL tworzącego drugą tabelę
$queryCreateTable2 = '
CREATE TABLE Orders
(
id INT AUTO_INCREMENT,
description TEXT NOT NULL,
PRIMARY KEY (id)
)
';

//Zapisz w poniższej zmiennej kod zapytania SQL tworzącego trzecią tabelę
$queryCreateTable3 = '
CREATE TABLE Clients
(
  id INT AUTO_INCREMENT,
  name VARCHAR(32) NOT NULL,
  surname VARCHAR(32) NOT NULL,
  PRIMARY KEY(id)
)

';


