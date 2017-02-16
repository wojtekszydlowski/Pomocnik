<?php
/*
FUNKCJA DATE():

Składdnia:
string date ( string $format [, int $znacznik_czasu ] )

Przyjmujemy, że jest 10.03.2015 r., 14:09:36
echo(date('H:i:s')); //14:09:36
echo(date('m.d.y')); //03.10.15
echo(date("j, n, Y")); //28, 3, 2015
echo(date('h-i-s, j-m-y')); //02-09-36, 10-03-15
echo(date('F j, Y, g:i a')); //March 10, 2015, 2:09 pm
echo(date("D M j G:i:s T Y")); //Tue Mar 10 14:09:36 CET 2015

Szczegółowa lista parametrów funckji date(): http://php.net/manual/pl/function.date.php

-----

FUNKCJA TIME():

timestamp to liczba sekund, które upłynęły od 1.1.1970 00:00:00 (moment ten nazywany jest Epoch).
Funkcja time() zwraca liczbę sekund, które upłynęły od Epoch do teraz.

//liczba sekund od Epoch
$aktualnyCzas = time();

//godzina ma 3600 sekund
$zaGodzine = $aktualnyCzas + 3600;

//wyświetli datę 'za godzinę'
echo(date("r", $zaGodzine));

// wyświetli datę '2 dni temu'
$dwaDniTemu = $aktualnyCzas - (3600 * 24 * 2);
echo(date("r", $dwaDniTemu));


-----

FUNKCJA STRTOTIME():


$teraz = strtotime("now"); //teraz
$jutro = strtotime("+1 day"); //jutro
$zaTydzien = strtotime("+1 week"); //za tydzień
$kiedys = strtotime("+1 week 2 days 4 hours 2 seconds"); //za tydzień, dwa dni, 4 godziny i 2 sekundy
$nastepnyCzwartek = strtotime("next Thursday"); //następny czwartek
$poprzedniPon = strtotime("last Monday"); ////poprzedni poniedziałek

echo(date('d.m.Y H:i:s', $jutro));
echo(date('d.m.Y H:i:s', $nastepnyCzwartek));
echo(date('d.m.Y H:i:s', $poprzedniPon));


-----

KONWERSJA DO TIMESTAMP - FUNKCJA MKTIME():

mktime () - jako parametry przyjmuje ona odpowiednio godzinę, minutę, sekundę, miesiąc, dzień, rok i opcjonalnie informację o tym, czy jest to czas letni (0) czy zimowy (1).

$dzien = 10;
$miesiac = 3;
$rok = 2015;
$godzina = 14;
$minuta = 09;
$sekunda = 36;

$date = mktime($godzina, $minuta, $sekunda, $miesiac, $dzien, $rok);


-----

CHECKDATE - SPRAWDZANIE POPRAWNOŚCI DATY:

-Dzięki funkcji checkdate() możemy sprawdzić poprawność daty (bez godziny). Jako parametr przyjmuje ona odpowiednio miesiąc, dzień i rok.
-Funkcja zwraca wartość true, jeżeli data jest poprawna, w przeciwnym wypadku – false.

$dzien = 10;
$miesiac = 3;
$rok = 2015;

var_dump(checkdate($miesiac, $dzien, $rok));
var_dump(checkdate(2, 29, 2015));
var_dump(checkdate(13, 21, 2015));


------


PORÓWNYWANIE DAT:

Często trzeba porównywać daty i określić, która jest wcześniejsza lub późniejsza.
Pamiętamy, że aby dwie zmienne mogły być porównane, muszą być zmiennymi tego samego typu.
W PHP nie ma typu danych dotyczących dat – najwygodniej porównywać je po przekonwertowaniu do formatu timestamp.
Przy porównywaniu dat w formacie timestamp możemy używać operatorów ==, <, >.

$data1 = '2015-03-09';
$data2 = '2015-06-11';
$data1Arr = explode('-', $data1);
$data2Arr = explode('-', $data2);
$data1Ts = mktime(0, 0, 0, $data1Arr[1],
$data1Arr[2], $data1Arr[0]);
$data2Ts = mktime(0, 0, 0, $data2Arr[1],
$data2Arr[2], $data2Arr[0]);

var_dump($data1Ts == $data2Ts);
var_dump($data1Ts > $data2Ts);
var_dump($data1Ts < $data2Ts);






 */