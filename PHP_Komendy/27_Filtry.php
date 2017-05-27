<?php
/*
#Filtry:
Filtry umożliwiają walidację danych przetwarzanych przez skrypt. Dane otrzymywane w zapytaniu nie muszą odpowiadać naszym założeniom.
Na przykład adres email może zawierać nieprawidłowe znaki lub mieć zły format.

filter_has_var – sprawdza, czy istnieje zmienna danego typu
type – INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_SERVER, INPUT_ENV

Przykład:
filter_has_var(INPUT_GET, 'test')

--

filter_var – filtruje zmienną i zwraca wartość po filtrowaniu (przetworzeniu) lub false, jeżeli nie udało się przefiltrować zmiennej.

Przykłądy:
filter_var('http://coderslab.pl', FILTER_VALIDATE_URL);
filter_var('email@something.com', FILTER_VALIDATE_EMAIL);
filter_var('79.123.123.3', FILTER_VALIDATE_IP)

--

filter_input – filtruje zmienną zewnętrzną i zwraca wartość po filtrowaniu (przetworzeniu). Zwraca false – jeżeli nie udało się przefiltrować
zmiennej, null – jeżeli zmienna nie istnieje.

Przykłady:
filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
filter_input(INPUT_GET, 'search', FILTER_SANITIZE_ENCODED);

--

#Wybrane rodzaje filtrów:

Walidacja:
FILTER_VALIDATE_BOOLEAN
FILTER_VALIDATE_EMAIL
FILTER_VALIDATE_INT
FILTER_VALIDATE_IP
FILTER_VALIDATE_URL

Czyszczenie:
FILTER_SANITIZE_EMAIL
FILTER_SANITIZE_ENCODED
FILTER_SANITIZE_STRING
FILTER_SANITIZE_URL

*/



#PRZYKŁADY:
/**
Napisz funkcję, która jako argument otrzyma tablicę z następującymi adresami:

MAIL,
URL,
IP.

Funkcja następnie sprawdzi za pomocą filtrów, czy podane dane są prawidłowe. Funkcja ma zwrócić tablicę zawierającą:

pojedynczy klucz (czyli przekazany adres),
wartość true lub false – w zależności od tego, czy adres jest prawidłowy czy nie.

 */

//function checkArray ($array) {
////echo $array[1];
//    $newArray=[];
//    $newArray[0][0] = $array[0];
//    $var = filter_var($array[0], FILTER_VALIDATE_EMAIL);
//
//    $newArray[0][1] = $array[0];
//    echo ( filter_var($array[0], FILTER_VALIDATE_EMAIL) ) . "<br>";
//    echo filter_var($array[1], FILTER_VALIDATE_URL) . "<br>";
//    echo filter_var($array[2], FILTER_VALIDATE_IP) . "<br>";
//}



function checkArray ($array) {
    $resultArr = [];
    $resultArr['mail'] = filter_var($array['mail'], FILTER_VALIDATE_EMAIL) ? true : false;
    $resultArr['url'] = filter_var($array['url'], FILTER_VALIDATE_URL) ? true : false;
    $resultArr['ip'] = filter_var($array['ip'], FILTER_VALIDATE_IP) ? true : false;
    return $resultArr;

}

$array = array ('mail' =>'wojtekszydlowski@gmail.com', 'url' => 'http://www.google.com', 'ip'=>'79.123.123.3');
var_dump (checkArray ($array));