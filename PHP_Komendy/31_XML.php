<?php
/*

#XML - Dekodowanie:

Oto dwie podstawowe metody czytania danych XML:

1.W postaci drzewa (SimpleXML)
-Proste, łatwe do zaimplementowania.
-Naturalne.
-Wymaga dużo pamięci i zasobów.

2.Poprzez eventy
-Szybkie i wydajne.
-Skomplikowane i trudne w utrzymaniu.

Przykład pliku XML:

<?xml version="1.0" encoding="UTF-8"?>
<ksiazka-telefoniczna kategoria="bohaterowie książek">
<!-- komentarz -->
 <osoba charakter="dobry">
  <imie>Ambroży</imie>
  <nazwisko>Kleks</nazwisko>
  <telefon>123-456-789</telefon>
 </osoba>
 <osoba charakter="zły">
  <imie>Alojzy</imie>
  <nazwisko>Bąbel</nazwisko>
  <telefon/>
 </osoba>
</ksiazka-telefoniczna>

--

#SimpleXML:

Wczytywanie:
simplexml_load_file – wczytuje strukturę z pliku,
simplexml_load_string – wczytuje strukturę ze stringu np. zmiennej zawierającej XML.

Obiekty SimpleXML tworzą drzewo, którego struktura odpowiada strukturze kodu XML.
Każdemu elementowi XML odpowiada jeden obiekt SimpleXML, zaś atrybuty są zwracane w postaci tablicy asocjacyjnej.
SimpleXMLElement wymaga, aby drzewo dokumentu XML zmieściło się w pamięci.

Jeśli kod XML zawiera więcej takich samych elementów wtedy elementy te zostaną umieszczone w tablicy (w naszym przykładzie osoby).
Załóżmy, że nasz plik (Przykład pliku XML) nazywa się ksiazka.xml

Przykład:

$ksiazka = simplexml_load_file('ksiazka.xml');
$ksiazka->getName();

$ksiazka->osoba[0]['charakter'];  //dobry
$ksiazka->osoba[1]->nazwisko;  //Bąbel

--

#SimpleXML z xpath:
Funkcja xpath pozwala na przeszukiwania drzewa XML przy wykorzystaniu zapytań xpath.

WYRAŻENIE           - ZNACZENIE
osoba               - Znajduje wszystkie węzły osoba.
osoba/imie          - Znajduje wszystkie węzły imie, które są dziećmi węzła typu osoba.
osoba/imie[1]       - Wybiera pierwszy węzeł imie będący dzieckiem węzła osoba.
osoba/*             - Wybiera wszystkie dzieci węzła osoba.
//osoba[@charakter] - Wybiera wszystkie węzły osoba z atrybutem charakter.
osoba/imie[text()]  - Wybiera tekst węzła imie.


Przykład:

$ksiazka = simplexml_load_file('ksiazka.xml');
$osoby = $ksiazka->xpath('osoba');
foreach($osoby as $osoba){
  echo $osoba->imie . ' ' . $osoba->nazwisko;
};


---

#XMLReader:
-Czyta dokument XML węzeł po węźle.
-Nie ma możliwości wglądu w cały dokument, a tylko w bieżący węzeł.
-Ponieważ nie wczytuje całego pliku do pamięci, pozwala na odczytanie nawet bardzo dużych plików.

Przykład:

$xml = file_get_contents('ksiazka.xml');
$ksiazka = new XMLReader();
$ksiazka->xml($xml);

while( $ksiazka->read() ) {
 echo($ksiazka->name);

 if($ksiazka->hasValue ) {
  echo($ksiazka->value);
 }

 if($ksiazka->name == 'osoba') {
  echo($ksiazka->getAttribute ('charakter'));
 }
}


WŁASNOŚĆ                     ZNACZENIE
attributeCount             - Liczba atrybutów w węźle
baseURI                    - Adres URI węzła
depth                      - Głębokość węzła w dokumencie XML
hasAttributes              - Czy element ma atrybuty
hasValue                   - Czy element ma wartość tekstową
isDefault                  - Czy atrybut jest domyślny
isEmptyElement             - Czy tag HTML jest pusty
localName                  - Nazwa lokalna węzła
name                       - Pełna kwalifikowana nazwa węzła
namespaceURI               - Adres URI przestrzeni nazw węzła ze zbioru
nodeType                   - Kod reprezentujący typ węzła
prefix                     - Prefix przestrzeni nazw węzła
value                      - Wartość tekstowa węzła
xmlLang                    - Zakres xml:lang w którym znajduje się wezeł
XMLReader::open()          - Pobierz URI zawierający dokument XML, który ma być analizowany.
XMLReader::close()         - Zamknij dokument
XMLReader::read()          - Przejdź do następnego węzła.
XMLReader::next()          - Przejdź do następnego węzła, pomiń poddrzewa.
XMLReader::getAttribute()  - Pobierz wartość atrybutu.
XMLReader::expand()        - Zwróć kopię bieżącego węzła jako dokument DOM.
XMLReader::readString()    - Pobiera wartość aktualnego węzła jako string

*/


#Przykład 1 - SimpleXML

/**
Napisz stronę pokazującą listę zajęć na uniwersytecie, korzystając z danych w pliku xml/reed.xml. Skorzystaj z SimpleXML.

Przykład jednego:
<course>
<reg_num>20573</reg_num>
<subj>ANTH</subj>
<crse>344</crse>
<sect>S01</sect>
<title>Sex and Gender</title>
<units>1.0</units>
<instructor>Makley</instructor>
<days>T-Th</days>
<time>
<start_time>10:30AM</start_time>
<end_time>11:50</end_time>
</time>
<place>
<building>VOLLUM</building>
<room>120</room>
</place>
</course>
 */

$xml = simplexml_load_file('xml/reed.xml');
//var_dump($xml);

$courses = $xml->xpath('course');

$uniqeTitles = [];
foreach($courses as $course){
    $uniqeTitles[$course->title->__toString()] =  $course->title; //__toString() zamienia obiekt na string
    //echo $course->title . ': ' . $course->instructor . "<br>"; //to też działa
};

foreach ($uniqeTitles as $uniqeTitle)
{
    echo $uniqeTitle . "<br>";

}
