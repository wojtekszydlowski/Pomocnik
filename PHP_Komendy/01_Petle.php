<?php

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

