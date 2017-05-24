<?php
/*

PRZYDATNE FUNKCJE DLA TABLIC:
http://php.net/manual/pl/function.count.php

count ($tablica) - podaje ilość elementów w tablicy
in_array ($igła, $tablica) — Sprawdza czy wartość $igła istnieje w tablicy $tablica np. if( !in_array( $randNumber, $losowaneLiczby ) )
array_sum ($tablica) — Oblicza sumę wszystkich wartości w tablicy $tablica
unset ($tablica[$i]) - Usuwa z tablicy $tablica element o indeksie $i

TABLICE można tworzyć na 3 sposoby:

-przypisując na bieżąco wartości dla poszczególnych indeksów:
$array[0] = 1;
$array[1] = 2;
$array[2] = 3;

-za pomocą konstrukcji array():
$array2 = array(4, 5, 6, 7, 8);

-za pomocą konstrukcji [] (od PHP 5.4):
$array3 = [7, 8, 9, 10];

-----

TABLICE ASOCJACYJNE czyli takie, które są indeksowane kluczem, którym może być również ciąg znaków:

$namesArray = array(
'imię' => 'Jan',
'nazwisko' => 'Kowalski',
'miasto' => 'Warszawa',
'ulica' => 'Hoża'
);


-----

WYŚWIETLANIE ELEMENTÓW TABLICY:

$array = array(1, 2, 3, 4, 5);

Do każdego elementu osobno:
echo($array[0]);
echo($array[1]);
echo($array[2]);
echo($array[3]);
echo($array[4]);

Za pomocą pętli:
for($i = 0; $i < count($array); $i++) {
echo($array[$i]);
}


Za pomocą foreach - przechodzi po kolei po każdym elemencie tablicy:
$namesArray = array(
'imię' => 'Jan',
'nazwisko' => 'Kowalski',
'miasto' => 'Warszawa'
);

foreach($namesArray as $name) {echo("Imię: $name <br>”); } // W zmiennej $name będą kolejne elementy z tablicy $namesArray

WAŻNE: Aby otrzymać jeszcze wartość klucza do zmiennej nazwanej $key:
foreach($namesArray as $key => $name) { echo("Imię pod kluczem $key to: $name <br>”);}


-----

OPERACJE NA TABLICACH:

1.Dodawanie tablic - służy do tego operator +. Wynikiem dodawania tablic tablica zawierająca wszystkie elementy z tablicy stojącej po lewej stronie operatora + oraz elementy z tablicy po prawej stronie operatora, które nie powtarzają się w tablicy z lewej strony operatora.

$dataArray = array(
'imie' => 'Jan',
'nazwisko' => 'Kowalski',
'miasto' => 'Warszawa'
);

$imageArray = array(
'wzrost' => '180',
'kolorOczu' => 'niebieskie'
);
$lientData = $dataArray + $imageArray;


2.Porównywanie tablic - operacje ==, !=, <>
-Operator == sprawdza, czy tablice są równe. Dwie tablice są równe, gdy mają taką samą liczbę elementów oraz te same wartości (tablice klasyczne) lub pary klucz => wartość (tablice asocjacyjne). Kolejność elementów nie jest istotna. Typy elementów nie są sprawdzane.
-Operatory != oraz <> sprawdzają, czy tablice są różne. Dwie tablice są różne, jeśli nie jest spełniony przynajmniej jeden z warunków równości tablic.


$client1 = array(
'imie' => 'Anna',
'miasto' => 'Warszawa'
);


$client2 = array(
'miasto' => 'Warszawa',
'imie' => 'Anna'
);

var_dump($client1 == $client2); //true

3.Porównanie tablic - operacje ===, !==
-Operator === sprawdza, czy tablice są identyczne. Dwie tablice są identyczne, gdy mają taką samą liczbę elementów oraz te same wartości (tablice klasyczne) lub pary klucz => wartość (tablice asocjacyjne). Kolejność elementów jest istotna. Typy elementów muszą się zgadzać.
-Operator !== sprawdza, czy tablice nie są identyczne. Dwie tablice nie są identyczne, jeśli nie jest spełniony przynajmniej jeden z warunków identyczności tablic.

$client1 = array(
'imie' => 'Anna',
'miasto' => 'Warszawa',
'wiek' => '28'
);

$client2 = array(
'imie' => 'Anna',
'miasto' => 'Warszawa',
'wiek' => 28
);

var_dump($client1 === $client2); //false


------

SORTOWANIE TABLIC:

Dla tablic klasycznych:
Funkcja sort() sortuje tablice (klasyczne), układa elementy od najmniejszego do największego.
Funkcja rsort() układa elementy od największego do najmniejszego.

Dla tablic asocjacyjnych:
Funkcja asort() sortuje tablice asocjacyjne. Układa ona elementy od najmniejszego do największego.
Funkcja arsort() sortuje tablice asocjacyjne w porządku odwrotnym.
Obydwie funkcje sortują tablice tak, że klucze zachowują przypisanie do odpowiednich wartości.

Przykład:
$capitals = array(
'Kanada' => 'Ottawa',
'Niemcy' => 'Berlin',
'Austria' => 'Wiedeń',
'Japonia' => 'Tokio'
);

Dla tablic asocjacyjnych według kluczy:
Funkcja ksort() sortuje tablice asocjacyjne według kluczy.

Przykład:
$capitals = array(
'Kanada' => 'Ottawa',
'Niemcy' => 'Berlin',
'Austria' => 'Wiedeń',
'Japonia' => 'Tokio'
);

ksort($capitals);
var_dump($capitals);



-------

TABLICE WIELOWYMIAROWE:

Tablice wielowymiarowe można deklarować podając kolejne indeksy w nawiasach kwadratowych:
  $dane[0]['imię'] = 'Jan';
  $dane[0]['nazwisko'] = 'Kowalski';
  $dane[0]['ulica'] = 'Kowalowska';

  $dane[1]['imię'] = 'Maciej';
  $dane[1]['nazwisko'] = 'Nowak';
  $dane[1]['ulica'] = 'Nowakowska';




 */

#Przykład 1: tablica z kontynentami i krajami na tych kontynentach - do zmiennej $kontynent zostanie przypisana nazwa klucza, natomiast do zmiennej $kraj wartość danego klucza.

echo "<table border=\"1\" cellspacing=\"2\">";
 echo "<tr>";
   echo "<td width=\"100%\" colspan=\"5\" align=\"center\">Kraje i kontynenty</td>";
 echo "</tr>";

$kraje = Array(
    'Europa' => array('Polska', 'Anglia', 'Litwa', 'Francja'),
    'Afryka' => array('Tunezja', 'Egipt', 'RPA', 'Etiopia'),
    'Azja' => array('Chiny', 'Mongolia', 'Japonia', 'Kazachstan')
);

foreach ( $kraje as $kontynent => $kraj )
{
    echo '<tr><td width="20%"><b>' . $kontynent . '</b></td>';

    for ( $i = 0; $i < count($kraj); $i++ )
    {
        echo '<td width="20%">' . $kraj[$i] . '</td>';
    }

    echo '</tr>';
}
echo "</table>";


# --------------


/*
Przykład 2:
Napisz dwie funkcje:

    print2DTable($table), która wyświetli tablicę dwuwymiarową w postaci macierzy,
    getMatrixTrace($array), która obliczy ślad macierzy (sumę elementów na głównej przekątnej) przekazanej w parametrze.

Zakładamy, że tablica reprezentuje macierz kwadratową (liczba wierszy równa liczbie kolumn).
 */

$tabMulti = [
    [2, 4, 8, 16],
    [32, 64, 128, 256],
    [512, 1024, 2048, 4096],
    [16, 256, 4, 2048]
];


function print2DTable($tab){
    echo '<table>';

    foreach ($tab as $row ){

        echo '<tr>';
        foreach ($row as $element) {
            echo '<td>' . $element . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}


function getMatrixTrace($tab) {
    $suma = 0;
    $numberCol = 0;
    foreach ($tab as $row){
        $numberRow = 0;
        foreach ($row as $element){
            if ($numberRow == $numberCol) {$suma += $element;}
            $numberRow += 1;
        }
        $numberCol +=1;
    }
    return $suma;
}

/*Przykład z wykorzystaniem pętli for
for ($i = 0; $i < count ($tabMulti); $i++){
    for ($j = 0; $j < count($tabMulti[$i]); $j++) {
        echo $tabMulti[$i][$j];
    }
}
*/

#innym sposobem zrobione
function getMatrixTrace2($tab)
{
    $suma = 0;
    for ($i = 0; $i < count($tab); $i++) {
        for ($j = $i; $j <= $i; $j++) {
            $suma += $tab[$i][$j];
        }
    }
}
print2DTable ($tabMulti);
echo getMatrixTrace ($tabMulti) . '<br>';

echo getMatrixTrace2 ($tabMulti);
//echo $tabMulti[0][0];




?>