<?php
/*

W PHP dostępnych jest kilka mechanizmów przekazywania informacji między skryptami:
• dołączanie parametrów do hiperłączy (metoda GET),
• formularze (metoda GET i POST),
• sesje (tablica $_SESSION),
• ciasteczka (tablica $_COOKIE).


PRZESYŁANIE I ODBIERANIE ZA POMOCĄ GET

Jest to metoda w której wartości naszych zmiennych są ukryte w adresie url.

Wysyłanie za pomocą GET na inną stronę - w linku po "?" (znaku zapytania) zaszywamy zmienne np.
<a href="strona2.php?foo=32&bar=Some_text">

Odbieranie za pomocą GET:
-Wszystkie dane które przesyłamy metodą GET znajdują się w zmiennej superglobalnej $_GET.
-Wartość zmiennej znajduje się pod takim samym kluczem jak nazwa która znajduje się w adresie.

if($_SERVER['REQUEST_METHOD'] === 'GET'){ //sprawdzamy czy użytkownik przesłał dane metodą GET
if(isset($_GET['name']) === true) { //Sprawdzamy czy zostały przekazane odpowiednie informacje

echo('Witaj na stronie 2. Metodą Get przesłałeś imię:' . $_GET['name']); //Używamy przesłanych informacji
}
else{
echo('Witaj na stronie 2. Metodą Get nie zostały przekazane dane pod kluczem name');
}
}


 */

#Przykład:

#Na stronie 1 (index.php):
?>

<a href="numbers.php?start=3&end=12">Link od 3 do 12</a><br>
<a href="numbers.php?start=30&end=120">Link od 30 do 120</a><br>
<a href="numbers.php?start=8&end=50">Link od 8 do 50</a>

<?php

#Na stronie drugiej (numbers.php) odbieramy te dane

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['start']) && isset($_GET['end'])) {

        for ($i = $_GET['start']; $i <= $_GET['end']; $i++) {
            echo $i . '<br>';
        }
    }
}



# -----------------

/*

PRZESYŁANIE I ODBIERANIE ZA POMOCĄ POST

Odbieranie danych z formularza wysłanego za pomocą metody POST:

if($_SERVER['REQUEST_METHOD'] === 'POST'){ //Sprawdzamy czy weszliśmy na stronę metodą POST
$name = "";
$surname = "";
if(isset($_POST['name']) === true && strlen(trim($_POST['name'])) > 5){ //Sprawdzamy czy zostały przekazane odpowiednie informacje
$name = trim($_POST['name']); //Używamy przesłanych informacji
}
else{
echo( 'Brak przekazanych danych albo złe dane (imię musi mieć co najmniej 5 znaków)');
}
}


 */

# Przykład 1:

// tutaj umieść kod wyświetlający dane przesłane POST-em

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userName']) && isset($_POST['userSurname'])) {
        echo "Witaj ". $_POST['userName'] . " " . $_POST['userSurname'];
    }
}

?>


<form action="" method="POST"> <!-- w action="" oznacza, że wysyłanie będzie do tej samej stronu -->
    <label>
        Imię:
        <input type="text" name="userName">
    </label>
    <label>
        Nazwisko:
        <input type="text" name="userSurname">
    </label>
    <input type="submit">
</form>

<?php


# --------------------

#Przykład 2:
#Na stronie napisz formularz, który będzie zawierał jedno pole tekstowe i jeden checkbox. Formularz ten ma przekierowywać do tej samej strony metodą POST. Skrypt ma sprawdzać, czy wpisany przez użytkownika tekst zawiera wulgaryzmy – jeżeli tak, to powinien zastąpić je dowolnymi znakami. Na przykład frazę „cholera, znowu to PHP“ powinien zastąpić frazą „*******, znowu to PHP“). Jeżeli użytkownik zaznaczy checkbox „Jestem świadomy konsekwencji“, to skrypt nie sprawdzi wulgaryzmów. Tekst wpisany przez użytkownika ma wyświetlić się (w formie ocenzurowanej lub nie) pod formularzem. Dodatkowo postaraj się, aby liczba gwiazdek odpowiadała liczbie znaków w cenzurowanym słowie.
#
$tab = array ('cholera', 'kurde', 'kurwa');

function zmien ($tekst){
    foreach ($tekst as $element) {
        $dlugosc = strlen($element);
        $zamienGwiazdkami = "";
        for ($i = 1; $i <= $dlugosc; $i++) $zamienGwiazdkami .= "*";
        $tekst = str_replace( $element, $zamienGwiazdkami, $tekst);
        return $tekst;

    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['userText'])) {
        $tekst = $_POST['userText'];
        if ($_POST['userAgreement'] === 1) zmien ($tekst);
        echo "$tekst<br>";
    }
}

?>


<form action="#" method="POST">
    <label>
        Twój tekst:
        <input type="text" name="userText">
    </label>
    <label>
        Jestem świadomy konsekwencji
        <input type="checkbox" name="userAgreement">
    </label>
    <input type="submit">
</form>



<?php

# -----------------------------------

#Napisz skrypt który będzie przeliczał temperaturę z stopniach celsjusza na temeraturę w stopniach fahrenheita (i w drugą stronę). Na stronie masz już przygotoway formularz. Formularz ma dwa guziki submit, z tą samą nazwą (atrybut name nastawiony na wartość convertionType) ale inną wartością (atrybut value). Żeby przekonać się który guzik został wciśnięty zobacz jaka będzie wartość w tablicy $_POST pod kluczem convertionType. Jeżeli chcesz więcej przeczyać o tym jak odróżniać który z guzików submit został naciśnięty możesz to zrobić http://stackoverflow.com/questions/2680160/how-can-i-tell-which-button-was-clicked-in-a-php-form-submit/2680198#2680198 . Żeby przeliczyć jednostki użyj wzorów znajdujących się https://pl.wikipedia.org/wiki/Skala_Fahrenheita#Spos.C3.B3b_dok.C5.82adny.

function convertCelcToFahr ($temperature) {
    $newTemp = 32 + (9 / 5) * $temperature;
    echo $newTemp;
}

function convertFahrToCelc ($temperature) {
    $newTemp = (5 / 9) * ($temperature - 32);
    echo $newTemp;
}

// Tutaj umieść kod który będzie wyświetlał przeliczoną wartość



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['degrees'])) {
        $temperature = $_POST['degrees'];
        if (isset($_POST['convertionType']) == 'celcToFahr') convertCelcToFahr ($temperature); else convertFahrToCelc ($temperature);

    }
}


?>

<form action="#" method="POST">
    <label>
        Temperatura:
        <input type="number" min="0.00" step="0.01" name="degrees">
    </label>
    <input type="submit" name="convertionType" value="celcToFahr">
    <input type="submit" name="convertionType" value="FahrToCelc">
</form>