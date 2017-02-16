<?php
/*
 Stosowane operatory:
|| - lub (można napisać też OR)
&& - i (można napisać też AND)

Operatory matematyczne: +, -, *, /, %.
% - pokazuje resztę z dzielenia np. $a = 10 % 3; -> pokaże 1;

Operatory przypisania:
$variable = 5;
$variable += 2; // $variable= $variable + 2
$variable -= 3; // $variable = $variable - 3
$variable *= 4; // $variable = $variable * 4
$variable /= 2; // $variable = $variable / 2
$variable %= 5; // $variable = $variable % 5;


Operatory równości:
Operatory porównujące wartości zmiennych: ==, !=, <>
Operatory porównujące wartości oraz typy zmiennych: ===, !==
Przykład:

$A = 5;
$B = 9;
$C = 5;
$D = 5.0;

$A == $B; -> Zwróci false (5 jest różne od 9)
$A != $B; -> Zwróci true (5 jest różne od 9)
$A <> $B; -> Zwróci true (5 jest różne od 9)

$A == $C; -> Zwróci true (5 jest równe zarówno 5 jak i 5.0)
$A == $D; -> Zwróci true (5 jest równe zarówno 5 jak i 5.0)

$A === $C; -> Zwróci true (5 jest równe 5)
$A === $D; -> Zwróci false (5 jest różne od 5.0 – inne typy)
$A !== $D; -> Zwróci true (5 jest różne od 5.0 – inne typy)


--------------

Zadanie:
 * Stwórz trzy zmienne ($a, $b, $c) z wartościami liczbowymi. Zakładamy, że $a <= $b <= $c. Napisz skrypt, który będzie sprawdzał, czy z boków $a, $b i $c można zbudować trójkąt. Jeżeli nie można zbudować tej figury geometrycznej – skrypt ma wypisywać odpowiedni komunikat. Jeśli można – skrypt ma wypisywać, jaki to trójkąt:

    równoramienny,
    równoboczny,
    różnoboczny.

 */

$a = 5;
$b = 5;
$c = 8;

if ( ($a + $b > $c) && ($a + $c > $b) && ($b + $c > $a) ) {

    #Sprawdzmy czy jest równoboczny

    if ( ($a == $b) && ($a == $c) && ($b == $c) ) {
        echo ' To trójkąt równoboczny';
    }
    #Sprawdzamy czy jest równoramienny
    else if ( ($a == $b) || ($a == $c) || ($b == $c) ) {
        echo 'To trójkąt równoramienny.';
    }
    # Trójkąt o różnych bokach
    else { echo 'To trójkąt o różnych bokach';
    }
} else {
    echo 'Trójkąta nie da się stworzyć.';
}