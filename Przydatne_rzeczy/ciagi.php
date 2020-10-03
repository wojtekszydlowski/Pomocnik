<?php
//Zmienia końce linii na znak <br> z html
$pricedescription = nl2br($pricedescription);

//Funkcja odwrotna do nl2br - zmiania <br> w znaki końca linii
$pricedescription = htmlspecialchars_decode($pricedescription); //jeśli ściągamy z bazy danych i mamy usunięte znaki specjalne to najpierw ta funkcja
$pricedescription = preg_replace('#<br\s*/?> #i', "\n", $pricedescription); //tutaj przed #i jest spacja - potrzebna gdy ciąg pobrany z bazy z usuniętymi znakiami specjalnymi
$pricedescription = preg_replace('#<br\s*/?>#i', "\n", $pricedescription); // tą drugą linijkę też trzeba dodać, aby pozbyć się ostatniego <br>



function cutstring($tekst,$ile){

// pozbywam się tagów HTML z tekstu
    $tekst = strip_tags($tekst);

// jeśli tekst jest dłuższy od podanej ilość znaków w zmiennej $ile
// wykonuje się warunek
    if (strlen($tekst) > $ile) {

// pierwsze skrócenie tekstu
        $tekst=substr($tekst, 0, $ile);

// drugie skrócenie tekstu - skraca do momentu wystąpienia ostatniej spacji w skróconym tekście
// przez co nie ucina nam słów w połowie i nie wyskakują "krzaki"
        for ($a=strlen($tekst)-1;$a>=0;$a--) {
            if ($tekst[$a]==" ") {

//wyświetlenie na końcu tekstu trzech kropek
                $tekst=substr($tekst, 0, $a)."...";
                break;
            };
        };
    };

// zwracanie prze-formatowanego tekstu
    return $tekst;
}


//Funckcja zamieniająca polskie znaki na angielksie (żeby było bez ogonków)
function plCharset($string) {

    $string = strtolower($string);
    $polskie = array(',', ' - ',' ','ę', 'Ę', 'ó', 'Ó', 'Ą', 'ą', 'Ś', 's', 'ł', 'Ł', 'ż', 'Ż', 'Ź', 'ź', 'ć', 'Ć', 'ń', 'Ń','-',"'","/","?", '"', ":", 'ś', '!','.', '&', '&', '#', ';', '[',']','domena.pl', '(', ')', '`', '%', '”', '„', '…');
    $miedzyn = array('-','-','-','e', 'e', 'o', 'o', 'a', 'a', 's', 's', 'l', 'l', 'z', 'z', 'z', 'z', 'c', 'c', 'n', 'n','-',"","","","","",'s','','', '', '', '', '', '', '', '', '', '', '', '', '');
    $string = str_replace($polskie, $miedzyn, $string);

// usuń wszytko co jest niedozwolonym znakiem
    $string = preg_replace('/[^0-9a-z\-]+/', '', $string);

// zredukuj liczbę myślników do jednego obok siebie
    $string = preg_replace('/[\-]+/', '-', $string);

// usuwamy możliwe myślniki na początku i końcu
    $string = trim($string, '-');

    $string = stripslashes($string);

// na wszelki wypadek
    $string = urlencode($string);

    return $string;
}