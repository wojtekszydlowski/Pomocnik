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

Można też tak - wyciągnąć pojedynczy znak:
$str = "Ala ma kota";
$str[0] // pokaże: A
$str[1] // pokaże: l

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

Przykład:
$str = "Ala ma kota";
explode(' ', $str);
explode(' ', $str); //array('Ala','ma','kota')
implode('_', explode(' ', $str)) //ala_ma_kota

-------

FUNKCJE NA STRINGACH:

strlen ($string) //Zwraca długość łańcucha znaków.

trim ($str [, string $character_mask = " \t\n\r\0\x0B" ] ) //Usuwa niechciane znaki (domyślnie białe znaki) z początku i końca łańcucha znaków.

strcmp (string $str1, string $str2)
Porównuje dwa łańcuchy znaków.
Zwraca następujące wartości:
<0 – gdy $str1 jest mniejsze od $str2,
>0 – gdy $str1 jest większe od $str2,
0 – gdy oba łańcuchy znaków są takie same.
Funkcja jest wykorzystywana do sortowania łańcucha znaków.

str_replace ($search , $replace , $subject [, int &$count ])
Wyszukuje w $subject wystąpienia $search i zmienia je na $replace.
$search i $replace mogą być również tablicami, wtedy są szukane wszystkie elementy z tablicy $search, następnie zamieniane są na odpowiadające im elementy tablicy $replace. Funkcja zwraca wynikowy łańcuch znaków.

strstr ($haystack , $needle [, bool $before_needle = false ])
Znajduje pierwsze wystąpienie $needle w zmiennej $haystack. Zwraca część zmiennej $haystack od początku wystąpienia $needle do końca.
Jeżeli $needle nie został znaleziony zwraca false.

strpos ( $haystack , $needle [, int $offset = 0 ] )
Działa podobnie jak strstr, ale zwraca pozycję (indeks) pierwszego wystąpienia $needle. Jeżeli $needle nie został znaleziony zwraca false.

strtolower ($string) //Zwraca wejściowy łańcuch znaków po zamianie wszystkich liter na małe.

strtoupper ($string) //Zwraca wejściowy łańcuch znaków po zamianie wszystkie liter na wielkie.

ucfirst ($str) //Zwraca wejściowy łańcuch znaków po zamianie pierwszej litery na wielką.

ucwords ($str) //Zwraca wejściowy łańcuch znaków po zamianie pierwszej litery każdego wyrazu na wielką.

addslashes ($str) // Dodaje odwrotne ukośniki przez znakami, które tego wymagają, przykłądowo przy zapytaniach do bazy w celu uniknięcia sql injection

stripslashes ($str) //Usuwa działanie funkcji addslashes.

strip_tags ($str [, string $allowable_tags ]) //Usuwa tagi HTML z podanego łańcucha znaków.

parse_str (string $str [, array &$arr ]) //Analizuje wejściowy łańcuch znaków $str, traktuje go jako ciąg parametrów zapytania.
Poszczególne parametry zapytania zapisywane są w tablicy $arr.

-----

FUNKCJE NIEWRAŻLIWE NA WIELKOŚĆ LITER
Wiele funkcji wyszukujących ma swoje odpowiedniki nierozróżniające wielkich i małych liter.
Te funkcje mają dodane w swojej nazwie literę i. Na przykład odpowiednikiem str_replace jest str_ireplace.
Te funkcje działają tak samo jak ich odpowiedniki wrażliwe na wielkość znaków.

 */


//----------------------

//PRZYKŁADY:

/**
Napisz trzy funkcje. Każda z nich powinna przyjmować adres email (napis w postaci imię.nazwisko@firma.com.pl) i zwracać:

Imię i nazwisko wyciągnięte z maila. Pamiętaj, że zarówno imię, jak i nazwisko rozpoczynają się dużą literą.
Nazwę firmy i nazwisko.
Inicjały danej osoby.

 */

function getName ($email) {
    $imieinazwisko = strstr($email, "@",true);
    $imieinazwisko = explode('.',$imieinazwisko);
    $imieinazwisko = implode(" ",$imieinazwisko);
    $imieinazwisko = ucwords($imieinazwisko);
    return $imieinazwisko;

}

function getNameAndCompany ($email) {
    $nazwisko = explode (" ",getName ($email))[1];
    $firma = strstr($email, "@");
    $dotposition = strpos($firma, ".");
    $firma = substr($firma,1,$dotposition-1);
    return $nazwisko . " " . $firma;


}

function getInitials ($email) {
    $name = getName($email);
    $array = explode(" ",$name);
    return $array[0][0].$array[1][0];
}

$email = "wojtek.szydlowski@firma.com.pl";
echo getInitials($email);
echo "<br>";
//echo f2($email);