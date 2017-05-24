<?php
/*
ZMIENNE LOKALNE - występują tylko wewnątrz funckji, później są niszczone po wykonaniu funkcji

Przykład:
function showInnerCost() {
$innerCost = 60;
# Zmienna lokalna o zasięgu funkcji, niewidoczna poza funkcją.
echo("Moje koszty własne = $innerCost");
}
showInnerCost();
echo("Ogólne koszty własne = $innerCost");
#Spowoduje wyświetlenie Warninga (ostrzeżenia) jako że zmienna nie ma wartości.

-----

ZMIENNE GLOBALNE - są dostępne w całym skrypcie. Aby odwołać się do zmiennej globalnej w funkcji należy w wewnątrz niej wskazać, że zmienna ta
jest zmienną globalną i ma być dostępna w ciele tej funkcji.

Przykład:
$globalCost= 100; //Zmienna globalna o zasięgu całego skryptu, ale niewidoczna wewnątrz funkcji.
function addGlobalCostToInnerCost() {
global $globalCost; // Deklaracja powodująca że zmienna globalna jest widoczna w środku naszej funkcji.
$innerCost= 60;
return $globalCost + $innerCost;
}
echo("Suma kosztów=" .addGlobalCostToInnerCost() );

-----

ZMIENNE STATYCZNE - ich wartość nie jest niszczona wraz z końcem funkcji. Przy kolejnym wywołaniu funkcji zmienna statyczna będzie miała taką wartość, jaką miała po poprzednim wykonaniu tej funkcji.

Przykład:
function count() {
static $counter = 0; //Deklaracja zmiennej statycznej
echo($counter);
$counter = $counter + 1;
echo('<br>');

}

count(); // $counter jest tworzone – wartość jest równa 0
count(); // $counter już istnieje – wartość jest równa 1
count(); // $counter już istnieje – wartość jest równa 2

-----

STAŁE - to wartości, które nie będą się nigdy zmieniać. Jeśli potrzebujemy zadeklarować jakąś wartość, która w trakcie wykonywania skryptu nie będzie zmieniana, należy użyć stałej.
Do deklaracji stałej używany konstrukcji define('NAZWA_STALEJ', wartosc_stalej);
Nazwy stałej nie poprzedzamy znakiem $. Przyjęło się też, że nazwy stałych piszemy wielkimi literami. Stałe mogą przechowywać ciągi znaków, wartości liczbowe i logiczne. Mają zawsze zasięg globalny.
HINT: Zwyczajowo stałe definiujemy w oddzielnym pliku który potem jest załączany do naszego kodu

Przykład:
define('LICZBA_PI', 3.14); //definiujemy stałą LICZBA_PI
$promien = 15.5;
$pole = LICZBA_PI * $promien * $promien;
echo('Pole koła wynosi ' . $pole);


-----

ZMIENNE SUPERGLOBALNE - zmienne predefiniowane, które są dostępne z każdego miejsca w skrypcie i znajdują się one w tablicach asocjacyjnych:
$_SERVER – informacje o środowisku i serwerze na jakim wykonywany jest skrypt,
$_GET – zmienne HTTP GET,
$_POST – zmienne HTTP POST,
$_FILES – zmienne HTTP FILES odpowiedzialne za przesyłanie plików,
$_COOKIE – zmienne odpowiedzialne za pliki ciasteczek,
$_SESSION – zmienne sesyjne,
$_REQUEST – połączenie tablic $_GET, $_POST i $_COOKIE
$_ENV – zmienne środowiskowe.


$_SERVER['HTTP_REFERER'] – adres URL strony, z której użytkownik trafił na aktualnie wyświetlaną stronę.
$_SERVER['REMOTE_ADDR'] – adres IP użytkownika.
$_SERVER['REQUEST_URI'] – część aktualnego adresu URL (bez protokołu i domeny).
$_SERVER['HTTP_USER_AGENT'] – informacje o systemie operacyjnym i przeglądarce użytkownika


var_dump($_SERVER); - wyświetla zmienne superglobalne dotyczące środowiska i serwera, na którym wykonywany jest skrypt

Najważniejsza informacja znajdująca się w tablicy $_SERVER to informacją jaką metodą użytkownik wszedł na naszą stronę. Informacja o tym znajduje się w $_SERVER['REQUEST_METHOD']:

if($_SERVER['REQUEST_METHOD'] === 'POST'){ //instrukcje} - Weszliśmy na stronę przesyłając dane POST (formularz).
if($_SERVER['REQUEST_METHOD'] === 'GET'){ //instrukcje} - Weszliśmy na stronę przesyłając dane GET (formularz lub dane w linku).

 */