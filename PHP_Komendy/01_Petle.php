<?php

/*
Kontrola przepływu programu

IF i ELSE IF

if(wyrażenie_warunkowe) {
//instrukcja wykonywana,
//jeśli spełniony zostanie warunek
}
else if(inne_wyrażenie_warunkowe) {
//instrukcje wykonywana, jeśli spełniony
//zostanie drugi warunek, a pierwszy nie
}
else {
//instrukcja wykonywana, jeśli nie zostanie
//spełniony żaden z poprzednich warunków
}


Operator trójargumentowy:
$a = 5;
$b = 7;
$result = ($a == $b) ? 9 : 91;
w nawiasie sprawdzamy warunek, jeśli jest prawda do przyjmujemy 9, jeśli jest fałsz to przyjmujemy 91

 */


#Pętla while


#Składnia - while ($warunek) {komendy }
#Pętla wykonuje się dopóki warunek jest prawdziwy

#Przykład: Napisz program liczący sumę wszystkich liczb w podanym przedziale od x do y.

$suma = 0;
while ($x<=$y) {
    $suma = $suma + $x;
    $x++;
}
echo $suma;


# -------------------------------------------------

#Pętla for
#Składnia - for(inicjalizacja zmiennych; sprawdzenie warunku; modyfikacja zmiennych) { instrukcje do wykonania w pętli }

#Przykład: Napisz program, który na podstawie wartości zmiennej n wypisuje wszystkie liczby od zera do n i podaje czy jest parzysta czy nieparzysta


for ($i = 0; $i <=$n; $i++){
    echo "$i - ";
    if ($i % 2 == 0) {echo "parzysta<br>";} else {echo "nieparzysta<br>";}
    #można też zapisać jako
    #if ($i % 2) {echo "- nieparzysta";} else {echo "- parzysta";}
    #wartość 0 dla modulo (%) jest fałszem

}


/*
Napisz program rysujący na podstawie wartości zmiennej n następujący schemat (tutaj dla n = 5):

* 2 3 4 5
* * 3 4 5
* * * 4 5
* * * * 5
* * * * *
* * * * *
* * * * 5
* * * 4 5
* * 3 4 5
* 2 3 4 5

Użyj pętli zagnieżdżonych, aby narysować pierwszą połowę rysunku. Potem dopisz drugą parę pętli zagnieżdżonych, która dorysuje resztę.

 */
$n = 5;
for ($i = 1; $i <= $n; $i++){
    for ($j = 1; $j <= $n; $j++) {
        if ($i >= $j) {echo "* ";} else {echo $j . ' ';}
    }
    echo "<br>";

}

for ($i = $n; $i > 0; $i--){
    for ($j = 1; $j <= $n; $j++) {
        if ($i >= $j) {echo "* ";} else {echo $j . ' ';}
    }
    echo "<br>";

}

# -------------------------------------------------


#Instrukcja wyboru switch

/*
switch( $zmienna ) {
case wartość1:
instrukcja1;
break;
case wartość2:
instrukcja2;
break;
...
default:
instrukcjaN;
}
 */


/*
Zadanie: Program dnia pewnego seminarium wygląda następująco:
8–11 wykłady,
12–13 dyskusje,
14 obiad,
15–18 prelekcje,
19 kolacja. Napisz skrypt, który na podstawie wskazanej pory dnia (zmienna $godzina) wyświetli informacje o wszystkich zaplanowanych punktach dnia (w odstępach godzinnych) które wydarzą się po tej godzienie. Użyj instrukcji switch. Podajemy tylko pełne godziny.

Przykład:
$godzina = 13 ==> 13 dyskusje, 14 obiad, 15 prelekcje, 16 prelekcje, 17 prelekcje, 18 prelekcje, 19 kolacja
$godzina = 18 ==> 18 prelekcje, 19 kolacja
 */

$godzina = 11;

if (!is_int( $godzina ) ) {
    echo 'Podaj poprawną godzinę jako liczbę całkowitą<br>';
}
else {

    if ($godzina < 8) {
        echo 'Zajęcia zaczynają się od godziny 8.<br><br>';
        $godzina = 8;
    }
    echo 'Rozkład zajęć:<br>';
    switch ( $godzina ) {
        case 8:
            echo "godzina 8: wykłady<br>";
        case 9:
            echo "godzina 9: wykłady<br>";
        case 10:
            echo "godzina 10: wykłady<br>";
        case 11:
            echo "godzina 11: wykłady<br>";
        case 12:
            echo "godzina 12: dyskusje<br>";
        case 13:
            echo "godzina 13: dyskusje<br>";
        case 14:
            echo "godzina 14: obiad<br>";
        case 15:
            echo "godzina 15: prelekcje<br>";
        case 16:
            echo "godzina 16: prelekcje<br>";
        case 17:
            echo "godzina 17: prelekcje<br>";
        case 18:
            echo "godzina 18: prelekcje<br>";
        case 19:
            echo "godzina 19: kolacja<br>";
            break;
        default:
            echo "Po godzinie 19 nie ma już zajęć";

    }

# -------------------------------------------------

/*
FOREACH - służy wyłącznie do przeglądania zawartości typów złożonych takich jak tablice

$owoce = array('banan','gruszka','arbuz');

foreach($owoce as $item)
{
	echo "$item <br/>";
}

/* wyświetli:

banan
gruszka
arbuz


--


$plik = file("plik.txt");
echo '<ul>';
foreach($plik as $linia)
{
 echo '<li>'.trim($linia).'</li>';
}
echo '</ul>';

// pętla ma analizować tablicę $plik, a aktualnie przetwarzany element ma być zapisany w zmiennej $linia.


$plik = file('plik.txt');
echo '<ul>';
foreach($plik as $numer => $linia)
{
 echo '<li>Linia #'.$numer.': '.trim($linia).'</li>';
}
echo '</ul>';

//Foreach umożliwia nam także zwracanie nazw indeksów elementów:



*/