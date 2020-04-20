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