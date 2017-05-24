<?php
/*
SQL Injection jest bardzo częstym atakiem na bazy danych. Polega on na przekazaniu danych z formularza, które mają w sobie zapytanie SQL.
Przeanalizujmy taki kod:

$userName = _POST["name"];
$sql = "SELECT * FROM users WHERE name=".$userName;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
...
}


Co się stanie, jeżeli ktoś wpisał do naszego formularza taką wartość:
"xxx"; DROP TABLE users;

Nasze zapytanie SQL będzie wyglądać następująco:
SELECT * FROM users WHERE name="xxx"; DROP TABLE users;

Istnieją dwa sposoby zabezpieczania się przed tego typu atakami:
- Używanie funkcji czyszczących specjalne znaki z naszego inputu.
- Używanie prepared statements.


# CZYSZCZENIE SPECJALNYCH ZNAKÓW

Czyszczenie znaków specjalnych dla SQL odbywa się przez wywołanie metody real_escape_string() na obiekcie połączenia.
Zmienna zwrócona przez tę metodę może być bezpiecznie użyta w zapytaniach SQL.

$userName = $conn->real_escape_string($userName);


*/
$statement = $mysqli->prepare("INSERT INTO customers(name) VALUES (?)");
if ($statement === FALSE) {
    echo "Bład: (" . $mysqli->errno . ") " . $mysqli->error;
}


# Przykład 1:
$con=mysqli_connect("localhost","my_user","my_password","my_db");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
$age = mysqli_real_escape_string($con, $_POST['age']);

$sql="INSERT INTO Persons (FirstName, LastName, Age)
VALUES ('$firstname', '$lastname', '$age')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "1 record added";

mysqli_close($con);



# ------------------------

# Przykład 2: Formularz logowania:


$server = '127.0.0.1'; //== localhost  localhost == 127.0.0.1
$username = 'root';
$password = 'coderslab';
$dbname = 'login';

$conn = new mysqli($server,$username,$password,$dbname);

if ($conn->connect_error) {
    die ('Coś się popsuło...' . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    #przy takim zapytaniu można dokonać mysql injection
    //$sql = "SELECT * FROM users WHERE login='" . $_POST['login'] . "' AND password='" . $_POST['password'] . "'";
    #z zabezpieczeniem przed mysql injection
    $login = $_POST['login'];
    $password = $_POST['password'];
    #gdyby nie poniższe dwie linie, można by wpisać w hasło np:
    # ' OR ''='
    # i wtedy byłoby włamanie do bazy danych
    $login = $conn->real_escape_string($login);
    $password = $conn->real_escape_string($password);
    $sql = "SELECT * FROM users WHERE login='$login' AND password='$password'";
    $result = $conn->query($sql);
    $liczbarekordow = $result->num_rows;
    echo "Liczba znalezionych rekordów: " . $liczbarekordow . "<br>";
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logowanie - MySQL injection</title>
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
                <legend>Zaloguj się</legend>
                <div class="form-group">
                    <label for="name">Login</label>
                    <input type="text" class="form-control" name="login" id="login" maxlength="255"
                           placeholder="Twój login...">
                </div>
                <div class="form-group">
                    <label for="address">Hasło</label>
                    <input type="text" class="form-control" name="password" id="password" maxlength="255"
                           placeholder="Hasło...">
                </div>
                <button type="submit" name="submit" value="zaloguj" class="btn btn-primary">Zaloguj</button>
            </form>
            <hr>

        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

        </div>
    </div>
</div>

<?php

# ----------- KONIEC PRZYKŁADU 2-------------



# PREPARED STATEMENTS

/*
Prepared statements to funkcjonalność PHP, dzięki której możemy przygotować szablon zapytania SQL. Następnie taki szablon wypełniamy odpowiednimi danymi i uruchamiamy.

Obiekt prepared statements tworzymy przez użycie metody prepare() na obiekcie połączenia. Metoda ta zwróci FALSE, gdy nie powiedzie się stworzenie takiego zapytania. W miejsca w które potem podepniemy dane wstawiamy znak zapytania.

$statement = $mysqli->prepare("INSERT INTO customers(name) VALUES (?)");
if ($statement === FALSE) {
echo "Bład: (" . $mysqli->errno . ") " . $mysqli->error;
}
#W miejscu znaku zapytania pojawią się dane które będziemy bindować do zapytania

Do wcześniej przygotowanego obiektu prepared statement wpisujemy dane (jest to bindowanie danych). Następnie wywołujemy zapytanie.
Bindowanie danych do prepared statements polega na wywołaniu metody bind_param() na obiekcie zapytania.

bool mysqli_stmt::bind_param(string $types, mixed &$var1 [, mixed &$... ])

$stmt = $mysqli->prepare("INSERT INTO customers(name, age) VALUES (?,?)");
$stmt->bind_param('sd', $name, $age);

# Bindowane parametry pojawiają się w naszym zapytaniu

Bindowanie danych do prepared statements polega na wywołaniu metody bind_param() na obiekcie zapytania.
bool mysqli_stmt::bind_param(string $types, mixed &$var1 [, mixed &$... ])

$stmt = $mysqli->prepare("INSERT INTO customers(name, age) VALUES (?,?)");
$stmt->bind_param('sd', $name, $age);
gdzie pierwszy parametr w bind_param to:
i - Wartość przekazana będzie zmienną liczbową całkowitą
d - Wartość przekazana będzie zmienną liczbową zmiennoprzecinkową
s - Wartość przekazana będzie napisem
b - Wartość przekazana będzie BLOB (będzie wysyłana w paczkach)


Wywołanie wcześniej przygotowanego wyrażenia polega na użyciu metody execute() na obiekcie prepared statement. Metoda ta zwraca TRUE lub FALSE.

if (!$statement->execute()) {
echo "Bład: (" . $stmt->errno . ") " . $stmt->error;
}


*/