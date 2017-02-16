<?php
/*

SESJE

Zmienne sesyjne są przechowywane w tablicy superglobalnej $_SESSION.
Zmienne sesyjne rejestrujemy przez odwołanie się do tablicy $_SESSION tak jak do zwykłej tablicy.
Możemy usunąć zmienną sesyjną za pomocą funkcji unset().
Sesja kończy się w kilku przypadkach: zamknięciu przeglądarki, upłynięciu maksymalnego czasu określanego przez serwer, albo braku komunikacji klient-serwer przez dłuższy czas.


session_start();  //uruchamiamy sesję zawsze na początku
if(!isset($_SESSION['licznik'])) {$_SESSION['licznik'] = 1;}
else {$_SESSION['licznik']++;}
echo('liczba odświeżeń: ' . $_SESSION['licznik']);


Przykład 1:
Pierwsza strona ma nastawiać informacje w sesji pod kluczem counter na 0.
Druga strona ma wyświetlać zawartość sesji pod kluczem counter i zwiększać ją o 1. Jeżeli nie ma takich danych w sesji, to strona powinna wyświetlić odpowiednie informacje.
Trzecia strona powinna kasować dane z sesji (tylko te trzymane pod kluczem counter).

Strona 1:
session_start(); //uruchomienie sesji
$_SESSION['counter'] = 0; //ustawienie licznika jako zmienną w sersji na 0

Strona 2:
session_start();

if (isset($_SESSION['counter'])) {
    $_SESSION['counter']++;
    $counter = $_SESSION['counter'];
}
else
{
    $counter = "Brak wartości";
}

Strona 3:
session_start();
if ($_SESSION['counter']) {
    unset ($_SESSION['counter']); //usuwa sesję
}


-----

Przykład 2:
Napisz skrypt, który na podstawie podanych ocen (formularz ocen z przedmiotów) liczy ich średnią arytmetyczną. Oceny trzymaj w tablicy, którą będziesz wkładać do sesji. Zadbaj o walidację wprowadzanych ocen (nie mniej niż 1 i nie więcej niż 6). Pamiętaj, żeby sprawdzać, czy tablica z ocenami istnieje w sesji – jeżeli nie, to ją stwórz (wkładając do sesji pustą tablicę). Wszystkie zapamiętane oceny i ich średnia powinny być wyświetlane pod formularzem. Do trzymania tablicy w sesji użyj funkcje serialize, a do wczytania unserialize.


session_start();
if (!isset($_SESSION['Degrees'])) $_SESSION['Degrees'] = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['degree']) && $_POST['degree'] >=1 && $_POST['degree'] <=6){
        $_SESSION['Degrees'][] = $_POST['degree'];
    }
}

if (!empty($_SESSION['Degrees'])) {
    $avg = array_sum($_SESSION['Degrees']) / count ($_SESSION['Degrees']);
    }
    else
    {
        $avg = 0;
    }

<table border='1'>
    <tbody>
    <tr>
        <?php
        if (!empty($_SESSION['Degrees'])) {
            foreach ($_SESSION['Degrees'] as $grade) {
                echo "<td>" . $grade . "</td>";
            }
        }
        ?>
    </tr>
    </tbody>
</table>

echo "<br>Średnia ocena: $avg<br>";

<form action="" method="POST">
    <label>
        Ocena:
        <input type="number" min="1" max="6" step="1" name="degree">
    </label>
    <input type="submit">
</form>


---------------------------

CIASTECZKA

Ciasteczka przekazywane są za pomocą nagłówków HTTP. W związku z tym musimy zagwarantować że zostaną one wysłane zanim na stronie pojawi się jakakolwiek treść:
-Przed zapisaniem ciasteczka nie może być żadnego wywołania funkcji echo i pochodnych.
-Element otwierający tryb PHP musi być pierwszym znakiem w pliku

Jako że ciasteczka nie są trzymane na serwerze, tylko na komputerze klienta, pamiętajcie że będą one widoczne dopiero po odświeżeniu strony!

Funkcja setcookie() służy do tworzenia i zapisywania ciasteczek. Jako parametry przyjmuje:
1.nazwę ciasteczka,
2.jego wartość,
3.czas wygaśnięcia (w formacie timestamp),
4.ścieżkę, z której dostępne będzie ciasteczko (domyślnie ścieżka do skryptu, w którym ciasteczko zostało utworzone),
5.domenę, z której dostępne będzie ciasteczko (domyślnie domena, pod którą znajduje się skrypt, w którym ciasteczko zostało utworzone),
6.sposób przesyłania – czy ciasteczko ma być przesyłane szyfrowanym połączeniem HTTPS,
7. tylko HTTP – określa, czy ciasteczko ma być dostępne tylko przez protokół HTTP,

Przykłady:
setcookie('jezyk', 'en', time() + 3600 * 24); - ustawia cookie o nazwie "jezyk" i wartości "en" na okres 24 godzin (3600 sekund * 24)

---

Odczyt ciasteczek:
-PHP automatycznie odczytuje ciasteczka i zamienia je na zmienne.
-Są one przechowywane w superglobalnej tablicy asocjacyjnej $_COOKIE.
-Kluczami w tablicy $_COOKIE są nazwy ciasteczek.

Przykłady:
<?php
if( !isset($_COOKIE['jezyk']) ) { //Jeżeli nie ma takiego ciasteczka to je utwórz
setcookie('jezyk', 'en', time() + 3600 * 24);
echo('ciasteczko utworzone');
}
else {
var_dump($_COOKIE['jezyk']); // Jeżeli istnieje takie ciasteczko to wyświetl jego wartość
}
?>

---

Aby usunąć ciasteczko należy użyć funkcji setcookie(), podając czas wygaśnięcia wcześniejszy niż aktualny np.:
if(isset($_COOKIE['jezyk'])) {setcookie('jezyk', 'en', time() - 3600); echo('ciasteczko język usuniete<br>');}

---

Przechowywanie tablic w ciasteczkach:
-Jeżeli chcemy w ciasteczku przechowywać tablicę, należy zamienić ją na ciąg znaków. Służy do tego funkcja serialize(). Odwrotnego procesu dokonuje funkcja unserialize().

Przykład:
<?php
$klient = array(
'imię' => 'Łukasz',
'nazwisko' => 'Pokrzywa',
'miasto' => 'Warszawa'
);

if(!isset($_COOKIE['klient'])) {
setcookie('klient', serialize($klient), time() + 3600 * 24);
echo('ciasteczko utworzone');
}
if(isset($_COOKIE['klient'])) {
var_dump($_COOKIE['klient']);
var_dump(unserialize($_COOKIE['klient']));
}
?>


-----

PRZYKŁADY Z CIASTECZKAMI:

Przykład 1:
Pierwsza strona ma nastawiać ciasteczko o nazwie User na Twoje imię.
Druga strona ma wyświetlać zawartość ciasteczka User. Jeżeli nie ma takiego ciasteczka, to powinna wyświetlić odpowiednie informacje.
Trzecia strona powinna kasować ciasteczko o nazwie User.


Strona 1:
if (!isset($_COOKIE['user'])) {
    setcookie ('user', 'Wojtek', time() + 3600); //ustawienie ciasteczka na 1 godzinę
}

Strona 2:
if (isset($_COOKIE['user'])) {
        echo "<h1> Wartość wczytana z ciasteczka to:". $_COOKIE['user'] . "</h1>";
        var_dump($_COOKIE['user']);
    }
    else {
        echo "<h1> Brak ciasteczka</h1>";
    }

Strona 3:
if (isset($_COOKIE['user'])) {
    setcookie('user', null, time()-1);
}

---

Przykład 2:
W tym zadaniu stwórz dwie strony:
Na pierwszej stronie powinien znajdować się formularz z dwoma polami tekstowymi:
-pierwsze pole ma przybierać nazwę ciasteczka,
-drugie – jego wartość.
Formularz ma przekierowywać do tej samej strony metodą POST. Jeżeli na tę stronę wejdziemy metodą POST, to ma ono tworzyć nowe ciasteczko o podanej nazwie i wartości. Na drugiej stronie wyświetl wszystkie ciasteczka, do których masz dostęp. Jak wczytać wszystkie ciasteczka opisane jest na stronie: http://stackoverflow.com/questions/9577029/can-i-display-all-the-cookies-i-set-in-php

Strona 1:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cookieName']) && isset($_POST['cookieValue'])){
        $cookieName = str_replace(' ', '_', $_POST['cookieName']);
        $cookieName = trim ($cookieName);
        setcookie ($cookieName, $_POST['cookieValue'], time() + 3600);
    }
}

<form action="" method="POST">
        <label>
            Nazwa ciasteczka:
            <input type="text" name="cookieName">
        </label>
        <label>
            Wartość ciasteczka:
            <input type="text" name="cookieValue">
        </label>
        <input type="submit">
    </form>


Strona 2:
    if($_COOKIE) {
        foreach ($_COOKIE as $key => $cookie) {
            echo "<li>" . $key . ' =>' . $cookie . "</li>";
        }

    }


---

Przykład 3:
W tym zadaniu stwórz dwie strony. Na pierwszej stronie wyświetl wszystkie ciasteczka, do których masz dostęp. Przy każdym z nich wygeneruj link do drugiej strony przekazując GET-em nazwę ciasteczka. Na drugiej stronie poinformuj o tym, że usuwasz ciasteczko i następnie je usuń. Nazwę ciasteczka pobierz z GET.

Strona 1:
    <h1> Wszystkie ciasteczka w systemie: </h1>
    <?php
    if($_COOKIE) {
        foreach ($_COOKIE as $key => $cookie) {
            echo "<li>" . $key . ' =>' . $cookie . " <a href='delCookie.php?usunCookie=$key'>Usuń ciastko o kluczu $key</a></li>";
        }
    }


Strona 2:
    <h1> Ciasteczko o nazwie:
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $usunCookie = $_GET['usunCookie'];
            echo $usunCookie . " i mające wartość " . $_COOKIE[$usunCookie] . " zostało usunięte";
            setcookie($usunCookie, null, time()-1);
        }
        ?>
    </h1>

---

Przykład 4:
Stwórz stronę select_language.php na której znajduje się formularz z elementem oraz dwoma opcjami wyboru - język Polski i język Angielski. Strona ma przesyłać dane za pomocą POST do strony set_language.php która ma nastawić ciasteczko lnaguage na wartość wybraną przez użytkownika. Po ponownym wejściu na stronę select_language.php powinna być wyświetlana informacja o wybranym przez użytkownika języku.

Strona 1 (select_language.php):

<form action="set_language.php" method="POST">
    <label>
        Wybierz język:
        <select name="language">
            <option value="en">angielski</option>
            <option value="pl">polski</option>
        </select>
    </label>
    <input type="submit">
</form>

    <!-- Tutaj umieść formularz do wybierania języka -->
<?php
if (isset($_COOKIE['language'])) {
    echo "Wybranym językiem jest język ";
    if ($_COOKIE['language'] == 'en') {echo "angielski<br>";} else { echo "polski<br>";}
}
else {
    echo "Nie masz jeszcze wybranego języka<br>";
}



Strona 2 (set_language.php):
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if (isset($_POST['language'])){
    setcookie ('language', $_POST['language'], time() + 3600);
}
}
?>

 */