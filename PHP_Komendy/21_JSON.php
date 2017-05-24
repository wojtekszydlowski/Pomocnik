<?php
/*
JSON - JavaScript Object Notation to lekki format wymiany danych. JSON jest formatem tekstowym przyjaznym użytkownikom oraz całkowicie zrozumiałym dla większości języków programowania.

Główne cechy JSON-a
-Prosta, naturalna składnia.
-Mały narzut.
-Prosta składnia = ograniczone zastosowania.

JSON jest formatem wymiany danych często wypierającym XML, gdy rozbudowane możliwości XML-a nie są wymagane.

Typy danych:
-Liczba Dane
-Ciąg znaków
-Wartość logiczna
-Obiekt
-Tablica
-Null

Składnia:
Dane: "nazwa": wartość
Obiekt: { "nazwa" : wartość, "nazwa2" : "wartość2" }
Tablica: [ { "nazwa": 12 }, { "nazwa": 13 } ]

Dekodowanie danych w formacie JSON:
mixed json_decode ( string $json [, bool $assoc = false [, int $depth = 512 [, int $options = 0 ]]] )
gdzie $assoc = true oznacza, że zwracane obiekty zostaną przekonwertowane do tablic asocjacyjnych.


Kodowanie danych do formatu JSON:
string json_encode ( mixed $value [, int $options = 0 [, int $depth = 512 ]] )

Błędy w czasie dekodowania/kodowania:
int json_last_error ( void )


Przykład 1:
$json = '{"książki": [
{"tytuł": "T1","liczba_stron": 10,"dostępna": false},
{"tytuł": "T2","liczba_stron": 50,"dostępna": true}
]}';

json_decode($json);

Wynik:
object(stdClass)#1 (1) {
  ["książki"]=> array(2) {
     [0]=> object(stdClass)#2 (3) {
       ["tytuł"]=> string(6) "Title1"
       ["liczba_stron"]=> int(10)
       ["dostępna"]=> bool(false)
     }
     [1]=> object(stdClass)#3 (3) {
       ["tytuł"]=> string(6) "Title2"
       ["liczba_stron"]=> int(50)
       ["dostępna"]=> bool(true)
     }
   }
}


json_decode($json, true);

Wynik:
array(1) {
    ["książki"]=> array(2) {
      [0]=> array(3) {
        ["tytuł"]=> string(6)
      "Title1"
        ["liczba_stron"]=>
      int(10)
        ["dostępna"]=>
      bool(false)
     }
     [1]=> array(3) {
         ["tytuł"]=> string(6)
      "Title2"
         ["liczba_stron"]=>
       int(50)
         ["dostępna"]=>
       bool(true)
     }
  }
}

--

Przykład 2:

$dane = array('książki' => array(
     array('title' => 'T1', 'liczba_stron' => 12),
     array('title' => 'T2', 'liczba_stron' => 12),
));

json_encode($dane);

Wynik:
{
   "książki":[
       {"title":"T1","liczba_stron":12},
       {"title":"T2","liczba_stron":12}
    ]
}

----

#Serializacja Obiektów w PHP:
W PHP możemy łatwo zaimplementować za pomocą interfejsu obsługę serializacji naszego obiektu. Standardowe przekazanie obiektu do funkcji json_encode() nie zadziała.
Pozwoli nam to bezpośrednio w obiekcie za pomocą metody interfejsu obsłużyć dane jakie mają być zwrócone do funkcji json_encode() a PHP automatycznie wywoła tą metodę.
Implementacja interfejsu oznacza, że w naszej klasie MUSIMY użyć metod jakie ten interfejs definiuje.
Interfejs to taki swego rodzaju szablon, który dodajemy do klasy.
Interfejsy dzielą się na wbudowane w PHP (które pewne akcje wykonują automatycznie) oraz takie, które piszemy samodzielnie, wówczas sami wywołujemy poszczególne metody.

-----

#Interfejs JsonSerializable
Pozwala na użycie obiektu w funkcji json_encode().
W metodzie jsonSerialize() implementujemy co ma być zwrócone i przekazane do funkcji json_encode() np. String lub Array

$obj = new ExampleObject();
json_encode($obj);//wywoła metode jsonSerialize() i przekaże jej rezultat do funkcji json_encode()

Metoda JsonSerializable jest wywoływana automatycznie przy przekazaniu obiektu do funkcji json_encode().

JsonSerializable{
// Metody
abstract public mixed jsonSerialize(void)
}


Przykład:
class Person implements JsonSerializable
{
   public function __construct($name, $age)
   {
     $this->name = $name;
     $this->age = $age;
   }
   public function jsonSerialize()  //Implementujemy metodę definiowaną przez interface
   {
      return [
       'name' => $this->name,
       'age' => $this->age
       ];
   }
}


$person1 = new Person('Marek', 27);
$serializedData = json_encode($person1);
//W tym momencie PHP automatycznie wywoła metodę jsonSerialize() w naszym obiekcie ponieważ zaimplementowaliśmy interfejs. Takie wywołanie spowoduje zwrócenie do funkcji serialize() tablicy i jej zserializowanie.

echo $serializedData;  //zwróci{"name":"Marek","age":27}

 */



$json = '{"książki": [
    {"tytuł": "T1","liczba_stron": 10,"dostępna": false},
    {"tytuł": "T2","liczba_stron": 50,"dostępna": true}
    ]}';

$json_decode_object = json_decode($json);
var_dump ($json_decode_object);

//tytuł 1 książki
echo ($json_decode_object->książki[0]->tytuł);
echo "<br>";

//liczba stron z 2 książki
echo ($json_decode_object->książki[1]->liczba_stron);

//--------------
//Ten sam przykład, tylko kiedy zamienimy jsona na tablicę

$json_decode_array = json_decode($json, true); //tworzy nam tablicę ascocjacyjną (klucz=>wartość) zamiast json'a
var_dump ($json_decode_object);

//tytuł 2 książki
echo ($json_decode_array['książki'][1]['tytuł']); //tutaj odwołujemy się do tablicy, a nie obiektu - inny zapis musi być
echo "<br>";

//liczba stron z 1 książki
echo ($json_decode_array["książki"][0]["liczba_stron"]);


//----------

//$dane = array('książki' => array(
//    array('title' => 'T1', 'liczba_stron' => 12),
//    array('title' => 'T2', 'liczba_stron' => 12),
//));

$data = ['książki' => [
    ['tytuł'=>'W pustyni i w puszczy',
        'liczba_stron'=>500],
    ['tytuł' => 'Harry Potter i zakon',
        'liczba_stron' =>502]
]
];

var_dump(json_encode($data)); //zamienia nam na string

//--------------------


//Serializacja Obiektów w PHP
/**
Metoda json_encode - przekazujemy do niej obiekt, a ta metoda na tym obiekcie wywołuje metodę object.jasonSerialize() - ta metoda jej coś zwraca i zamienia na string
 */

echo "Serializacja Obiektów w PHP:<br>";

class Person implements JsonSerializable
{
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function jsonSerialize()
    {
        return [ //tutaj wybieramy sobie co chcemy, aby było nam zwrócone - tutaj akurat wszystkie zmienne zwracamy.
            'name' => $this->name,
            'age' => $this->age
        ];
    }
}

$person1 = new Person('Marek', 27);//utworzono nową osobę
$serializedData = json_encode($person1); //użycie json_encode na tej osobie

echo $serializedData; // zwróci: {"name":"Marek","age":27}