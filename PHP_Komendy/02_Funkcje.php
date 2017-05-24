<?php

/*
FUNKCJE - PRZEKAZYWANIE PARAMETRÓW
Przekazywanie parametrów do funkcji może odbywać się przez wartość i przez referencję.

Przekazywanie parametrów do funkcji za pomocą referencji:
-Referencje można opisać jako „alias” (alternatywna nazwa służąca do identyfikacji) jakiejś zmiennej. Oznacza to że mamy jedną zmienną dostępną dla nas pod dwiema nazwami.
-Na liście parametrów funkcji parametr, który chcemy przekazać przez referencję, poprzedzamy znakiem &.
-Wszelkie zmiany wartości przekazanego parametru, jakie zostaną dokonane wewnątrz funkcji, będą obowiązywały także poza zasięgiem funkcji.

Przykład:
function calculateTip(&$baseAmount) {
//10% napiwku
$tip = $baseAmount * 0.1;
$baseAmount += $tip;
}
$myAmount = 50;
calculateTip($myAmount);
echo("razem do zapłaty: $myAmount ");
//Zmienne $baseAmount i $myAmount to jedna zmienna która teraz ma dwie nazwy.
 */

function calculateTip(&$baseAmount) {
//10% napiwku
    $tip = $baseAmount * 0.1;
    $baseAmount += $tip;
}
$myAmount = 50;
calculateTip($myAmount);
echo("razem do zapłaty: $myAmount ");
echo "<br><br><br>";


#Przykład funkcji z referencją

/* Napisz skrypt, który podaną przez użytkownika kwotę rozmieni na jak najmniejszą liczbę monet i banknotów o nominałach 1, 2, 5, 10 zł. Przykład:

    188 zł zostanie rozmienione na:
        18 banknotów 10 zł,
        1 moneta 5 zł,
        1 moneta 2 zł,
        1 moneta 1 zł.

Funkcja przyjmuje liczby całkowite, czyli podana kwota ma być w pełnych złotych. W skrypcie należy zdefiniować funkcję, w której kwota oraz liczba poszczególnych monet są parametrami funkcji (użyj referencji). Funkcja powinna ustawiać wartość zmiennych przekazanych jako referencje reprezentujących liczbę monet danego nominału tak, żeby po jej wykonaniu można było wyświetlić wynik.
 */

function oblicz ($wartosc, &$dziesiec, &$piec, &$dwa, &$jeden) {
    $dziesiec = floor ($wartosc / 10);
    $wartosc -= $dziesiec * 10; // Można to też zrobić na modulo np. $wartosc %= 10;

    $piec = floor ($wartosc / 5);
    $wartosc -= $piec * 5;

    $dwa = floor ($wartosc / 2);
    $wartosc -= $dwa * 2;

    $jeden = $wartosc;
}

$kwota = 188;
oblicz (188, $b10, $m5, $m2, $m1);
echo "Kwotę $kwota zł można rozmienić na:<br>";
echo '10zł banknotów: '.$b10.'<br>';
echo '5ł monet: '.$m5.'<br>';
echo '2zł monet: '.$m2.'<br>';
echo '1zł monet: '.$m1.'<br>';


# -----------------

/*
Liczba doskonała to taka liczba, która jest sumą wszystkich swoich dzielników. Jest to np. 6:
6 = 3 + 2 + 1
Liczba niekompletna to taka liczba, która jest większa od sumy wszystkich swoich dzielników. Jest to np. 10:
1+2+5=8 < 10
Napisz program, który wypisze wszystkie liczby do wcześniej zdefiniowanej liczby x. Określi przy tym, czy jest to liczba doskonała, niekompletna czy żadna z nich.
*/

function getNumbers( $n ){

    $sumaDzielnikow = 0;
    for( $i = 1; $i <= $n; $i++ ){
        echo "$i <br>";

        if( ($i <= $n/2) && ($n % $i == 0) ){
            $sumaDzielnikow += $i;
        }
    }


    if( $sumaDzielnikow == $n ){
        echo 'Liczba jest doskonała';

    } else if( $sumaDzielnikow < $n ){
        echo 'Liczba jest niekompletna';

    } else {
        echo 'To zwykła liczba';
    }
}
getNumbers( 10 );