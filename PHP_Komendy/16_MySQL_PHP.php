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
$conn = null;


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


# --------------------------------------

# Zadanie 3: Formularz dodający do bazy danych

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $server = '127.0.0.1'; //== localhost  localhost == 127.0.0.1
    $username = 'root';
    $password = 'coderslab';
    $baseName = "cinemas_ex";

    $conn = new mysqli($server, $username, $password, $baseName);

    if ($conn->connect_error) {
        die("Polaczenie nieudane. Blad: " .
            $conn->connect_error);
    }

    switch (($_POST['action'])) {
        case "cinema":
            if (isset ($_POST['name']) && isset ($_POST['address'])) {
                $cinemaName = $_POST['name'];
                $cinemaAddress = $_POST['address'];
                $sql = "INSERT INTO Cinemas (name, address) VALUES ('$cinemaName', '$cinemaAddress')";
                if ($conn->query($sql) === TRUE) {
                    $last_id = $conn->insert_id;
                    echo("Dodano nowe kino o numerze id: ". $last_id ."<br>");
                } else {
                    echo("Bład: " . $sql . "<br>" . $conn->error . "<br>");
                }

            }
            else {
                echo "Nie podano wszystkich danych. Nie można dodać nowego kina.<br>";
            }
            break;
        case "movie":
            if (isset ($_POST['name']) && isset ($_POST['description']) && isset ($_POST['rating']) && is_numeric($_POST['rating'])){
                $movieName = $_POST['name'];
                $movieDescription = $_POST['description'];
                $movieRating = $_POST['rating'];
                $sql = "INSERT INTO Movies (name, description, rating) VALUES ('$movieName', '$movieDescription', $movieRating)";
                if ($conn->query($sql) === TRUE) {
                    $last_id = $conn->insert_id;
                    echo("Dodano nowy film o numerze id: ". $last_id ."<br>");
                } else {
                    echo("Bład: " . $sql . "<br>" . $conn->error . "<br>");
                }

            }
            else {
                echo "Nie podano wszystkich danych. Nie można dodać nowego filmu.<br>";
            }
            break;

        case "payment":
            if (isset ($_POST['type']) && isset ($_POST['date']) && strlen($_POST['type']) >0 && strlen($_POST['date']) == 10) {
                $paymentType = $_POST['type'];
                //echo "payment: $paymentType";
                $paymentDate = $_POST['date'];
                $sql = "INSERT INTO Payments (type, date) VALUES ('$paymentType', '$paymentDate')";
                if ($conn->query($sql) === TRUE) {
                    $last_id = $conn->insert_id;
                    echo("Dodano nową płatność o numerze id: ". $last_id ."<br>");
                } else {
                    echo("Bład: " . $sql . "<br>" . $conn->error . "<br>");
                }

            }
            else {
                echo "Nie podano wszystkich danych. Nie można dodać nowej płatności.<br>";
            }

            break;



    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zadanie 3 - formularze dodawania do bazy</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body

<div class="container">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <form action="" method="post" role="form" class="cinema_form">
                <legend>Dodaj kino</legend>
                <div class="form-group">
                    <label for="name">Nazwa</label>
                    <input type="text" class="form-control" name="name" id="name" maxlength="255"
                           placeholder="Nazwa...">
                </div>
                <div class="form-group">
                    <label for="address">Adres</label>
                    <input type="text" class="form-control" name="address" id="address" maxlength="255"
                           placeholder="Adres...">
                </div>
                <input type="hidden" name="action" value="cinema">
                <button type="submit" name="submit" value="cinemas" class="btn btn-primary">Dodaj</button>
            </form>
            <hr>
            <form action="" method="post" role="form" class="movie_form">
                <legend>Dodaj film</legend>
                <div class="form-group">
                    <label for="name">Nazwa</label>
                    <input type="text" class="form-control" name="name" id="name" maxlength="255"
                           placeholder="Nazwa...">
                </div>
                <div class="form-group">
                    <label for="description">Opis</label>
                    <input type="text" class="form-control" name="description" id="description" maxlength="255"
                           placeholder="Opis...">
                </div>
                <div class="form-group">
                    <label for="rating">Ocena</label>
                    <input type="number" class="form-control" name="rating" id="rating" min="0" max="30" step="0.01"
                           placeholder="Ocena...">
                </div>
                <input type="hidden" name="action" value="movie">
                <button type="submit" name="submit" value="movies" class="btn btn-primary">Dodaj</button>
            </form>
            <hr>
            <form action="" method="post" role="form" class="payment_form">
                <legend>Dodaj płatność</legend>
                <div class="form-group">
                    <label for="type">Typ płatności</label>
                    <select name="type" id="type" class="form-control">
                        <option value=""> -- Wybierz Typ --</option>
                        <option value="transfer">Transfer</option>
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="date" class="form-control" name="date" id="date"
                           placeholder="Data...">
                </div>
                <input type="hidden" name="action" value="payment">
                <button type="submit" name="submit" value="payments" class="btn btn-primary">Dodaj</button>
            </form>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
    </div>
</div>
