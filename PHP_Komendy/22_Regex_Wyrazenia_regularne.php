<?php
/*
Link do sprawdzania wyrażeń: regex101.com


Wyrażenia regularne - definicja:
Wyrażenia regularne (regex) to wzorce opisujące łańcuchy symboli.
W informatyce teoretycznej ciągi znaków pozwalające opisywać języki regularne.
W praktyce znalazły bardzo szerokie zastosowanie, pozwalają bowiem w łatwy sposób opisywać wzorce tekstu.
Dwie najpopularniejsze składnie wyrażeń regularnych to składnia uniksowa i składnia perlowa.
W większości zastosowań stosuje się składnię perlową.

Podstawowe elementy:
-Każdy znak, oprócz znaków specjalnych, określa sam siebie, np. a oznacza znak a.
-Kolejne symbole oznaczają, że w łańcuchu muszą wystąpić dokładnie te symbole w dokładnie takiej samej kolejności, np. ab oznacza, że łańcuch musi składać się ze znaku a poprzedzającego znak b.

---

Znaki specjalne:
.        -> Dowolny znak z wyjątkiem znaku nowego wiersza
[]       -> Jeden dowolny znak ze znaków znajdujących się między nawiasami, np. [abc] – oznacza a, b lub c
[a-c]    -> Jeden znak z przedziału od a do c
[^...]   -> Jeden dowolny znak nieznajdujący się między nawiasami np.: [^abc] – oznacza jeden znak z wyjątkiem a, b i c.
()       -> To grupa symboli do późniejszego wykorzystania (przechwytywanie).
|        -> To odpowiednik słowa lub, oznacza wystąpienie jednego podanych wyrażeń, np.: a|b|c oznacza a lub b lub c.
^        -> Oznacza początek wiersza.
$        -> Oznacza koniec wiersza.
*        -> To zero lub więcej wystąpień poprzedzającego wyrażenia, np.: [abc]* – oznacza zero lub więcej znaków ze zbioru a, b, c.
+        -> To jedno wystąpienie lub więcej poprzedzającego wyrażenia.
?        -> To najwyżej jedno wystąpienie (może być zero) poprzedzającego wyrażenia.

Znaki specjalne jako zwykłe znaki:
Jeżeli chcemy, aby znak specjalny został potraktowany jako zwykły, to musimy go poprzedzić ukośnikiem wstecznym \.
Np.:
\. – to kropka a nie dowolny znak,
\.+ – to jedna kropka lub więcej.

---

Rozszerzenia:

KOD            ZNACZENIE
\d          -> Dowolna cyfra
\D          -> Dowolny znak niebędący cyfrą
\s          -> Dowolny znak biały (np. spacja, tabulator)
\S          -> Dowolny znak niebędący znakiem białym
\w          -> Dowolny znak wyrazu
\W          -> Dowolny znak niebędący znakiem wyrazu
\n          -> Nowa linia
\t          -> Tabulator
\r          -> Powrót karetki
[:digit:]   -> Dowolna cyfra
[:alpha:]   -> Dowolna litera
[:alnum:]   -> Dowolna cyfra i litera
{N}         -> Dokładnie N wystąpień
{N,}        -> Co najmniej N wystąpień
{N,M}       -> Od N do M wystąpień


----


Odwołania wsteczne:
Przechwycony wcześniej fragment może być wykorzystany później w wyrażeniu za pomocą odwołania wstecznego.
Do kolejnych fragmentów odwołujemy się poprzez \1 \2 \3 itd.

(\w+)=\1   -> Sprawdza czy przed znakiem równości w stringu znajduje się słowo \w+, przechwytuje je a nastepnie sprawdza czy za znakiem
              równości jest to samo słowo \1
Pasuje do:
Ala=Ala

---

Przechwytywanie nazwane:
Przechwytywany fragment tekstu możemy oznaczyć etykietą, dzięki temu łatwiej będzie się do niego odwołać.
(?P<etykieta>...)
i odwołać się poprzez:
(?P=etykieta)
/(?P<slowo>\w+)=(?P=slowo)/


---

Przydatne przykłady wyrażeń regularnych:

Wartość HEX:
^#?([a-f0-9]{6}|[a-f0-9]{3})$

Adres IP:
^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}
(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$

Tag HTML:
^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$

Kod pocztowy:
[0-9][0-9]-[0-9][0-9][0-9]

Adres email:
^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]
+(\.[a-zA-Z0-9-]{1,})*\.([a-zA-Z]{2,}){1}$

Godzina w formacie 24h:
([01]?[0-9]|2[0-3]):[0-5][0-9]


----

Separatory i wyrażenia zachłanne (greedy):

Separatory oddzielają poszczególne części wyrażenia.
Najczęściej stosowane separatory to: / # ~
/[0-9][0-9]-[0-9][0-9][0-9] /
/[0-9][0-9]-[0-9][0-9][0-9] /i

Wyrażenia zachłanne - Kwantyfikatory w wyrażeniach regularnych dopasowują tak wiele znaków jak to możliwe
[[Ala ma kota]] [[Ale kot nie ma Ali]]
(\[\[.*\]\])

Można tego uniknąć dzięki zdefiniowaniu znaków, które nie powinny wystąpić:
(\[\[[^\]]*\]\])
Można też dodać ? (znak zapytani) po kwantyfikatorze, który zmienia go na leniwy.


-----

Tryby dopasowania:
i – ignoruje wielkość liter w wyrażeniu,
m – wykonuje dopasowanie dla wielu linii,
s – kropka oznacz również znak nowej linii,
u – stosuje UTF-8,
U – domyślnie kwantyfikatory nie są zachłanne.

Tryby dopasowania można łączyć ze sobą:
/w+/iu


------

Wyrażenia regularne w PHP:

preg_match, preg_match_all – sprawdza, czy wyrażenie pasuje do podanego łańcucha znaków,

Funkcja zwraca następujące wartości:
• 1 – jeżeli jest dopasowanie,
• 0 – jeżeli nie ma dopasowania,
• false – jeżeli wystąpił błąd.

$subject = "abcdef";
$pattern = '/^def/';
preg_match($pattern, $subject, $matches);

--

preg_grep – wyszukuje elementy tablicy pasujące do wzoru.

$fl_array = preg_grep("/^(\d+)?\.\d+$/", $array);  // Zwraca wszystkie elementy będące liczbami zmiennoprzecinkowymi.

--

preg_replace – wyszukuje i zamienia wystąpienia wzorca podanym tekstem.

Kod
$string = 'April 15, 2003';
$pattern = '/(\w+) (\d+), (\d+)/i';
$replacement = '${1} 1,$3';
echo(preg_replace($pattern, $replacement, $string));

Wynik
April 1,2003

--

preg_split – dzieli łańcuch znaków przy użyciu wyrażenia regularnego oraz zwraca tablicę z wyodrębnionymi częściami.

$keywords = preg_split("/[\s,]+/", "hypertext language, programming");



 */


//---------------------------------

# PRZYKŁADY:

#Przykład #1:

//Czy zawiera dokładnie jedną cyfrę:
if(preg_match('/^[0-9]$/D', $_POST['cyfra']))

//Wykorzystaliśmy tutaj wzorzec /^[0-9]$/. Zawarty jest on wewnątrz ograniczników /. Poza nimi mogą znajdować się jedynie dodatkowe flagi kontrolne i nic więcej. Znak ^ oznacza początek ciągu, a znak $ koniec lub "prawie" koniec zezwalając na zakończenie wyrażenia przejściem do nowej linii \n. Zastosowane dodatkowo D wymusza interpretację $ jako bezwzględnego końca wyrażenia (możliwość dodania \n w niektórych przypadkach może być luką w bezpieczeństwie skryptu). [0-9] definiuje klasę dozwolonych znaków, jakie mogą pojawić się w danym miejscu. Ostatecznie wzorzec ten opisuje wszystkie ciągi składające się z DOKŁADNIE jednego znaku będącego cyfrą z przedziału 0 do 9.


// ----

#Przykład 2:

	if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(preg_match('/^[a-zA-Z0-9\.\-_]+\@[a-zA-Z0-9\.\-_]+\.[a-z]{2,4}$/D', $_POST['email']))
        {
            echo '<p>Wpisałeś e-mail '.$_POST['email'].'</p>';
        }
        else
        {
            echo '<p>Nieprawidłowe dane! Skrypt wymaga podania adresu e-mail!</p>';
        }
    }
    else
    {
        echo '<form method="post" action="preg2.php">
			Podaj adres e-mail: <input type="text" name="email"/><input type="submit" value="OK"/>
			</form>';
    }

    /*
Omówmy sobie poszczególne partie tego wyrażenia:

/^[a-zA-Z0-9\.\-_]+ - początek adresu składa się z dowolnych znaków alfanumerycznych, kropki, pauzy oraz podkreślenia i jego długość musi wynosić minimum 1 znak.
\@ - później ma być małpa
[a-zA-Z0-9\.\-_]+ - analogicznej klasy używamy do zdefiniowania domeny.
\.[a-z]{2,4}$/ - domena musi kończyć się kropką, po której spodziewamy się domeny nadrzędnej (np. .pl, .com).
W pełni poprawne wyrażenie sprawdzające poprawność adresu jest znacznie bardziej skomplikowane. Zainteresowanych odsyłamy do odpowiedniego dokumentu RFC definiującego je.

PCRE posiada kilka klas predefiniowanych:

. - kropka symbolizuje dowolny znak (za wyjątkiem przełamania linii).
\d - dowolna cyfra dziesiętna
\D - dowolny znak niebędący cyfrą
\s - biały znak (np. spacja, tabulator)
    */

//---------------------------


# Przykład 3:
/*
Napisz funkcje sprawdzającą, czy hasło spełnia wszystkie poniższe wymagania:

Ma od 10 do 15 znaków.
Ma minimum jedną małą literę.
Ma minimum jedną wielką literę.
Nie zawiera dwóch wielkich lub dwóch małych liter z rzędu.

Jeżeli hasło nie spełnia któregoś z wymagań – funkcja powinna zwrócić false. Napisz formularz, który będzie korzystał z podanej funkcji i walidował hasło.
 */

function verifyPassword ($password) {
    $isPasswordValid = true;
    if (!strlen($password) >= 10 && !strlen($password) < 16) {$isPasswordValid =  false;}

    $pattern = '/[a-z]+';
    if (preg_match($pattern, $password, $matches) != 1) {
        $isPasswordValid =  false;
    };

    $pattern = '/[A-Z]+';
    if (preg_match($pattern, $password, $matches) != 1) {
        $isPasswordValid =  false;
    };

    $pattern = '/([a-z][a-z])|([A-Z][A-Z]';
    if (preg_match($pattern, $password, $matches) != 1) {
        $isPasswordValid =  false;
    };


}

verifyPassword("testtesttest");

//------------------------


#Przykład 4:

/*
Napisz funkcję która znajdzie w tekście wszystkie cytaty i zwróci je w postaci tablicy z napisami. Dla uproszczenia zakładamy że cytaty są otoczone cudzysłowami. Np.:

$citeArray = findCitations('To jest jakiś tekst. "To jest cyctat1". To jest dalsza część tekstu. "To jest drugi cyctat".');

Powinno zwrócić następującą tablicę:

["To jest cyctat1", "To jest drugi cyctat"]

 */

//regex101.com

function cytaty ($text) {
    $pattern = '/"(.*?)"/';
    preg_match_all($pattern, $text, $matches);
    var_dump($matches);
    return $matches[1];
}

$text = 'To jest jakiś tekst. "To jest cyctat1". To jest dalsza część tekstu. "To jest drugi cyctat".';
print_r ( cytaty($text) );


//-----------------------

#Przykład 5:

/*
Napisz funkcję, która wyczyści z napisu wszystkie znaki specjalne.
 * Zakładamy, że znakami specjalnymi są wszystkie znaki oprócz cyfr, liter
 */

function removeSpecialChars ($text) {
    //$pattern = '/(\W)/';//usuwa wszystkie znaki oprócz liter i cyfr (również spacje)
    $pattern = '([^a-z A-Z0-9*&])';//usuwa wszystkie znaki oprócz liter, cyfr, spacji, gwiazdki i znaku &
    echo preg_replace($pattern,"",$text);
}

$text = "Dajcie mi jakiś tekst 59, ale ** * ,kw, znaki        @ d &specjalne gdzie?";
removeSpecialChars($text);