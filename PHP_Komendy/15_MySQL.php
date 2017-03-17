<?php
//localhost/phpmyadmin
//User: root
//Hasło: coderslab

//Tworzenie backupu bazy danych
# mysqldump -u [user_name] -p [database_name] > [file].sql

//Wczytywanie backupu - Baza danych o odpowiedniej nazwie musi być wcześniej stworzona i musi być pusta!
# mysql -u[user_name] -p < [file].sql

//Łączenie się z bazą - Jeżeli podamy nazwę bazy, od razu podłączymy się do tej bazy.
$conn = new mysqli(servername, username, password, [baseName]);

//Kończenie pracy z bazą
$conn->close();
$conn = null;

//Sprawdzanie błędów
if ($conn->connect_error) {
    die("Połączenie nieudane. Bład: " . $conn->connect_error);
}


//Przykład połączenia
$servername = "localhost";
$username = "username";
$password = "password";
$baseName = "sql_cwiczenia";

# Tworzenie nowego połączenia:
$conn = new mysqli($servername,
    $username,
    $password,
    $baseName);

# Sprawdzamy, czy połączenie się udało:
if ($conn->connect_error) {
    die("Polaczenie nieudane. Blad: " .
        $conn->connect_error);
}
echo("Polaczenie udane.");

# Niszczymy połączenie:
$conn->close();
$conn = null;

// ------------------------------

//Tworzenie nowej bazy danych
# CREATE DATABASE <nazwa_nowej_bazy>;

$sql = "CREATE DATABASE sql_cwiczenia";
$result = $conn->query($sql);
if ($result != FALSE) {
    echo("Baza stworzona poprawnie");

} else {
    echo("Błąd podczas tworzenia nowej bazy: "
        . $conn->error);
}


//Tworzenie nowej tabeli - Przyjęte jest, że pierwszy element takiej tabeli to ID.
# CREATE TABLE table_name
# (
# nazwa_kolumny_1 typ_danych(size) [atrybuty],
# nazwa_kolumny_2 typ_danych(size) [atrybuty],
# nazwa_kolumny_3 typ_danych(size) [atrybuty],
# ....
# );

# CREATE TABLE users
# (
# user_id int AUTO_INCREMENT,
# user_name varchar(255),
# user_email varchar(255) UNIQUE,
# PRIMARY KEY(user_id)
# );

$sql = "CREATE TABLE users (user_id int AUTO_INCREMENT,
user_name varchar(255),
user_email varchar(255) UNIQUE,
PRIMARY KEY(user_id))";
$result = $conn->query($sql);
if ($result === TRUE) {
    echo("Tabela Users została stworzona poprawnie");
} else {
    echo("Błąd podczas tworzenia tabeli: " . $conn->error);
}

// ------------------------------

//Typy danych w MySQL – liczby
# INT – podstawowa zmienna liczbowa. Jeżeli używana jest ze znakiem, to pomieści liczby w następującym przedziale: od –2 147 483 648 do 2 147 483 647. Jeżeli nie podamy znaku, to przedział ten wynosi od 0 do 4 294 967 295.
# TINYINT – najmniejsza zmienna liczbowa. Mieści przedział liczb od –128 do 127 (lub 0 do 255).
# SMALLINT – mała zmienna liczbowa. Mieści przedział liczb: od –32 768 do 32 767 (lub 0 do 65 535).
# MEDIUMINT – średnia zmienna liczbowa. Mieści przedział liczb: od –8 388 608 do 8 388 607 (lub od 0 do 16 777 215).
# BIGINT – duża zmienna liczbowa. Mieści od –9 223 372 036 854 775 808 do 9 223 372 036 854 775 807 (lub 0 do 18 446 744 073 709 551 615).
# FLOAT(M,D) – zmienna reprezentująca liczbę zmiennoprzecinkową. M – liczba wyświetlanych cyfr, D – liczba cyfr po przecinku, może trzymać do 24 miejsc po przecinku.
# DOUBLE(M,D) – liczba zmiennoprzecinkowa o większej dokładności. Może trzymać do 53 miejsc po przecinku. REAL jest synonimem zmiennej typu DOUBLE.
# DECIMAL(M,D) – liczba zmiennoprzecinkowa, do której nie używamy kompresji. NUMERIC jest synonimem DECIMAL.


//Typy danych w MySQL – data i czas
# DATE – data w formacie RRRR-MM-DD. Może trzymać daty od 1000-01-01 do 9999-12-31.
# TIMESTAMP – data trzymana w formacie RRRRMMDDGGMMSS. Może trzymać daty między 1 stycznia 1970 roku a 2038 rokiem.
# DATETIME – data w formacie RRRR-MM-DD GG:MM:SS. Może trzymać daty od 1000-01-01 00:00:00 do 9999-12-31 23:59:59.  TIME – trzyma czas w formacie GG:MM:SS.
# YEAR(M) – trzyma rok w formacie dwu- lub czterocyfrowym.


//Typy danych w MySQL – napisy
#CHAR(M) – napis mający z góry określoną liczbę znaków, parametr M przyjmuje wartość między 0 a 255. Wypełniany spacjami, jeżeli napis będzie krótszy.
# VARCHAR(M) – napis o zmiennej liczbie znaków, nie większej jednak niż podany parametr M (o wartości od 0 do 255).
# BLOB (Binary Large Object) lub TEXT – pole zawierające maksymalnie 65535 znaków. BLOB od zmiennej TEXT różni się tym, że porównanie zmiennej typu BLOB nie jest wrażliwe na wielkość znaków.
# TINYBLOB lub TINYTEXT – zmienna BLOB lub TEXT, ale o maksymalnej długości 255 znaków.
# MEDIUMBLOB lub MEDIUMTEXT – zmienna BLOB lub TEXT, ale o maksymalnej długości 16 777 215 znaków.
# LONGBLOB lub LONGTEXT – zmienna BLOB lub TEXT, ale o maksymalnej długości 4 294 967 295 znaków.

// ------------------------------


//Atrybuty danych w MySQL

# PRIMARY KEY – czyli klucz główny. Atrybut stosowany do wskazania, że ta kolumna będzie jednoznacznie identyfikowała każdy wpis. Zazwyczaj do stworzenia klucza głównego, używamy zmiennej typu INT z włączoną opcją AUTO_INCREMENT.
# UNSIGNED – stosowany przy zmiennych liczbowych.
# CHARACTER SET – stosowany przy napisach. Powoduje używanie odpowiedniego kodowania do napisów.
# ZEROFILL – stosowany przy zmiennych liczbowych. Powoduje dopełnienie liczby zerami poprzedzającymi.
# BINARY – Używany przy zmiennych typu CHAR lub VARCHAR. Powoduje, że sortowanie będzie case-sensitive.
# DEFAULT – nastawia domyślną wartość wpisywaną w tę kolumnę.
# AUTO_INCREMENT – stosowany przy zmiennych liczbowych. Powoduje, że wartość w tej kolumnie zwiększa się o jeden przy każdym wpisie.
# NULL / NOT NULL – pozwala (lub nie pozwala) na wprowadzanie pustych danych w tę kolumnę.


// ------------------------------

//Dodawanie elementów do tabeli

# INSERT INTO table_name(columnName1, columnName2, columnName3, ...) VALUES (value1, value2, value3, ...);

$sql = "INSERT INTO users(user_name, user_email) VALUES('Wojtek', 'wojtek@gmail.com')";
if ($conn->query($sql) === TRUE) {
    echo("Nowy user został dodany");
} else {
    echo("Bład: " . $sql . "<br>" . $conn->error);
}



//Ostatni wstawiony/edytowany element (w PHP)
//- Po każdej operacji wstawienia lub edycji możemy otrzymać ID (wartość klucza głównego) elementu, na którym pracowaliśmy. Jest on zapisany w atrybucie insert_id naszego połączenia.

$last_id = $conn->insert_id;
echo "Nowy rekord o id " . $last_id . " został wstawiony."; //Jest to jedyny sposób żeby móc dowiedzieć się o wartości klucza głównego dla właśnie wpisanego elementu.


// ------------------------------


//Wczytywanie elementów z tabeli

# SELECT column_name, column_name FROM table_name;
# SELECT * FROM table_name;

//Obiekt typu mysqli_result
//Metoda query w przypadku udanych zapytań SELECT, SHOW, DESCRIBE albo EXPLAIN zwraca nam obiekt klasy mysqli_result.
# result->num_rows - zwraca nam ilość wierszy zwrócone przez zapytanie,
# result->field_count – zwraca nam ilość kolumn zwróconych przez zapytanie.
# result->fetch_assoc() - zwraca nam jeden rząd z odpowiedzi jako tablice asocjacyjną lub NULL (jeżeli nie ma więcej rzędów). Tablica jako klucze ma nazwy kolumn.
# result->fetch_row() - zwraca nam jeden rząd z odpowiedzi jako tablice lub NULL (jeżeli nie ma więcej rzędów).


//wczytywanie za pomocą pętli while
$sql = "SELECT user_id, user_name FROM users";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    // Wypisz na ekran dane
    while($row = $result->fetch_assoc())
        {
        echo("id " . $row["user_id"]) .
            "imie" . $row["user_name"];
        }
}
else
    {
    echo("Brak wyników");
    }

//wczytywanie za pomocą pętli foreach
$sql = "SELECT user_id, user_name FROM users";
$result = $conn->query($sql);
foreach($row as $result) {
// Wypisz na ekran dane
    echo("id " . $row["user_id"]) .
        "imie" . $row["user_name"];
}


//Klauzula WHERE
# SELECT column_name, column_name FROM table_name WHERE column_name = <szukana wartość>;
# np. SELECT * FROM users WHERE user_name = "Wojtek";
# np. SELECT * FROM users WHERE user_name LIKE "W%";


// ------------------------------

// Klauzula AS

# Jeżeli z jakiegoś powodu w wynikach wyszukiwania mamy 2 kolumny o takiej samej nazwie to w PHP będziemy mieli dostęp tylko do jednej z nich (jeżeli korzystamy z funkcji zwracających tablice asocjacyjną).
# Możemy zawsze nadać kolumnie nową nazwę (alias) na czas tego wyszukania. Robimy to za pomocą klauzuli AS:
# SELECT column_name AS column_alias FROM table_name;
# SELECT user_id AS id FROM Users;


// Klauzula ORDER BY
# Możemy sortować znalezione wyniki względem jednej kolumny (lub więcej). Służy do tego klauzula ORDER BY
# SELECT column_name, column_name FROM table_name ORDER BY column_name ASC|DESC, column_name ASC|DESC;


// ------------------------------

//Zmiana wartości danych
# UPDATE table_name SET column1=value1, column2=value2, ... WHERE some_column=some_value;
# np. UPDATE users SET user_name="Grzesiek" WHERE user_id=2;

$sql = "UPDATE users SET user_name='Grzesiek' WHERE user_id=2";

if ($conn->query($sql) === TRUE) {
    echo "Wpis został poprawiany.";
} else {
    echo "Blad: " . $conn->error;
}


// ------------------------------


//Usuwanie danych z tabeli
# DELETE FROM table_name WHERE some_column=some_value;
# np. DELETE FROM users WHERE user_name="Grzesiek";

$sql = "DELETE FROM users WHERE user_name='Grzesiek'";
if ($conn->query($sql) === TRUE) {
    echo "Wpis został usunięty.";
} else {
    echo "Blad: " . $conn->error;
}


// ------------------------------


//Modyfikacja tabeli
# Wygląd tabeli (liczba kolumn, dane w nich przetrzymywane) możemy zmienić za pomocą ALTER TABLE:

//Dodanie nowej kolumny
# ALTER TABLE table_name ADD column_name datatype;

//Usunięcie kolumny
# ALTER TABLE table_name DROP COLUMN column_name;

//Zmiana danych trzymanych w kolumnie
# ALTER TABLE table_name MODIFY COLUMN column_name new_datatype;
# np. ALTER TABLE users MODIFY COLUMN user_name varchar(30);

// ------------------------------

//Usunięcie tabeli
# DROP TABLE table_name;

//Usunięcie całej bazy danych
# DROP DATABASE db_name;
