<?php
/*
STRING JAKO TABLICA:
$imie = 'Łukasz';
echo($imie[1]); //pokaże drugi znak ciągu (liczymy od 0) czyli 'u'

-----

ŁĄCZENIE STRINGÓW:
$imie = 'Łukasz';
$nazwisko = 'Pokrzywa';
$imieNazwisko = $imie . ' ' . $nazwisko;
echo($imieNazwisko); //Łukasz Pokrzywa

-----
PRZYPISANIE DLA STRINGÓW Z ZACHOWANIEM AKTUALNEJ WARTOŚCI ZMIENNEJ:
$tekst = 'łatwo jest programować';
$tekst .= ' w PHP';
echo($tekst); //łatwo jest programować w PHP

-----

WYCINANIE FRAGMENTU:
substr($string, $start, $dlugosc)

$tekst = 'laboratorium';
$foo = substr($tekst, 2, 5);
echo($foo); //borat
echo('<br>');
$foo = substr($tekst, -6, 3);
echo($foo); //tor
echo('<br>');
$foo = substr($tekst, 3);
echo($foo); //oratorium

-----

ROZBIJANIE I SKLEJANIE:
explode($separator, $string) – dzięki tej funkcji można rozbić string na kilka mniejszych fragmentów.

$godzina = '12:34:02';
$tablicaGodzina = explode(':', $godzina);
var_dump($tablicaGodzina);

implode($klej,$tablica) - odwrotna do explode - skleja ona w jeden łańcuch elementy tablicy podanej w drugim parametrze, wstawiając pomiędzy nimi znak podany jako pierwszy parametr.

$tablicaGodzina = array('12', '34', '02');
$godzina = implode(':', $tablicaGodzina);
echo($godzina);

 */