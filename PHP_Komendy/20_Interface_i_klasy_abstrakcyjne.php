<?php
/*
#Klasy abstrakcyjne:
-Klasy abstrakcyjne nie zawierają implementacji części (lub wszystkich) metod.
-Metody abstrakcyjne zawierają jedynie definicję samej metody (widoczność, liczbę i rodzaj argumentów) bez jej kodu.
-Obiekty tworzy się z klas dziedziczących zawierających implementacje metod abstrakcyjnych.
-Z klasy abstrakcyjnej nie można utworzyć obiektu.

Przykład dla klasy abstrakcyjnej:

[Definicja:]
abstract class Vehicle
{
public function go($speed) {
$this->startEngine();
}
public function stop() {
$this->stopEngine();
}
abstract protected function startEngine();
abstract protected function stopEngine();
}

[Wykorzystanie:]
class Car extends Vehicle
{
protected function startEngine() {
...
}
protected function stopEngine() {
...
}
}

Zgodność dostępu:
-Dziedzicząc po klasie abstrakcyjnej, musimy zachować zgodność atrybutów dostępu.
-Jeżeli klasa abstrakcyjna definiuje jakąś metodę jako publiczną, to w naszej klasie ta metoda musi również zostać zdefiniowana jako publiczna.
-Nasze metody muszą mieć widoczność taką samą lub większą niż metody z klasy abstrakcyjnej.

Zgodność argumentów:
-Dziedzicząc po klasie abstrakcyjnej, musimy zachować nie tylko zgodność dostępu, lecz także typów i liczby argumentów.
-Jeżeli klasa abstrakcyjna określa typ danego argumentu, to metoda w naszej klasie musi również przyjmować taki typ argumentów i zachowywać kolejność argumentów określoną w klasie abstrakcyjnej.
-Można dodać tylko argumenty z wartością domyślną.

---

#Klasy (metody) finalne
-Metody finalne nie mogą być przeciążane w klasach dziedziczących z danej klasy.
-Zdefiniowanie całej klasy jako finalnej spowoduje, iż inne klasy nie będą mogły z niej dziedziczyć.

[Wykorzystanie:]
final class Car extends Vehicle
{
final public function go($speed) {
 $this->startEngine();
 }
public function stop() {
 $this->stopEngine();
 }
}

---

#Interface:
-Interfejs pozwala określić, jakie metody musi zaimplementować klasa. Nie określa jednak, jak te metody powinny działać (podobnie jak klasa abstrakcyjna).
-Interfejs jest prostszy niż klasa. Zawiera tylko definicje metod (lub stałych), ale nie określa, jak te metody działają.
-W odróżnieniu od klasy abstrakcyjnej – w interfejsie wszystkie metody są abstrakcyjne z definicji.


[Definicja:]
interface Vehicle
{
public function go($speed);
public function go($speed);
}

[Wykorzystanie:]
class Car implements Vehicle
{
 public function go($speed) {
   $this->startEngine();
  }
 public function stop() {
   $this->stopEngine();
  }
}

Po co nam interfejsy?
-Dzięki interfejsom różne klasy mogą być wykorzystywane w ten sam sposób, bez konieczności dziedziczenia.
-Przykładowy interfejs Countable wymusza na nas implementacje metody count().
-Metoda count() jest używana później przez funkcje count() (tą samą której używacie do otrzymania informacji o długości tablicy).
-Jeżeli nasza klasa implementuje interfejs Countable to możemy obiekt tej klasy przekazać do funkcji count().

interface Countable {
   public function count();
}

--
Wiele interfejsów - Klasa – w przeciwieństwie do dziedziczenia – może implementować wiele różnych interfejsów:
class UFO implements Vehicle, Airplane, Spaceship {
...
}

--

Dziedziczenie interfejsów - Interfejsy mogą dziedziczyć z innych interfejsów:
Interface Bike {
}

Interface Motorbike extends Bike {
}

--
Zgodność argumentów:
-Przy implementacji interfejsu w klasie musimy zachować zgodność typów i liczby argumentów.
-Jeżeli interfejs określa typ danego argumentu, to metoda w klasie musi również przyjmować taki typ argumentów i zachowywać kolejność argumentów określoną w interfejsie.


----

#Interfejsy vs klasy abstrakcyjne:

Klasy abstrakcyjne:
-Klas abstrakcyjnych używamy,gdy klasy są ze sobą mocno powiązane.
-Na przykład jest taka sama część kodu i wspólne zmienne dla wszystkich klas dziedziczących z danej klasy, którą możemy zaimplementować
w klasie nadrzędnej.

Interfejsy
Interfejsy wykorzystujemy do zapewnienia tego samego zestawu metody dla klas, które nie są ze sobą mocno powiązane.

Interface – ma tylko abstrakcyjne metody (abstrakcyjne oznacza, że są tylko zdefiniowane – function i parametry, nie mają ciała czyli to co wewnątrz funkcji).
Klasy abstrakcyjne – mają przynajmniej jedną metodę abstrakcyjną, ale mogą mieć też zwykłe metody (z ciałem).

Abstrakcja – to kształt – klasa kształt. Ale ma w sobie np. metodę rysuj. I teraz jeśli chcemy mieć klasę koło, to może ona dziedziczyć po klasie kształt i dziedziczyć metodę rysuj.

-----

Interfejs Iterator:
-Pozwala na użycie obiektu w pętli foreach. Dzięki niemu możemy bez użycia dodatkowych metod przeiterować np. po własności obiektu
będącej tablicą.
-Metody iteratora są wywoływane automatycznie przy kolejnych iteracjach, do nas należy napisanie ich implementacji.
-Interfejs Iterator nie powoduje zamiany obiektu w tablicę a więc nie można takiego obiektu użyć np. w funkcjach tablic.

[Iterator:]
Iterator extends Traversable {
 //Metody:
abstract public mixed current(void)
abstract public scalar key(void)
abstract public void next(void)
abstract public void rewind(void)
abstract public boolean valid(void)
}

------

Interfejs ArrayAccess:
-Pozwala na użycie obiektu jak tablicy. Dzięki niemu możemy odwołać się do obiektu jak do tablicy:

$obj = new ExampleObject();
$obj['foo'] = 'bar';//wywoła metode offsetSet
echo $obj['foo'];//wywoła metode offsetGet

Metody ArrayAccess są wywoływane automatycznie przy próbie dostępu do obiektu jak tablicy.

Interfejs ArrayAccess nie powoduje zamiany obiektu w tablicę a więc nie można takiego obiektu użyć np. w funkcjach tablic.

ArrayAccess {
//Metody:
abstract public boolean offsetExists(mixed $offset)
abstract public mixed offsetGet(mixed $offset)
abstract public void offsetSet(mixed $offset, mixed $value)
abstract public void offsetUnset(mixed $offset)
}


-------

Interfejs JsonSerializable:
-Pozwala na użycie obiektu w funkcji serialize(). W metodzie jsonSerialize() implementujemy co ma być zwrócone i przekazane do funkcji
serialize() np. String lub Array

$obj = new ExampleObject();
serialize($obj);//wywoła metode jsonSerialize() i przekaże jej rezultat do funkcji serialize()

Metoda JsonSerializable jest wywoływana automatycznie przy przekazaniu obiektu do funkcji serialize().

JsonSerializable{
//Metody:
abstract public mixed jsonSerialize(void)
}


 */



//---------------------


#Przykład 1:

/**
Stwórz abstrakcyjną klasę User mającą:
Atrybuty username i password (zastanów się, jaki powinny mieć poziom dostępu).
Abstrakcyjną metodę checkLogin przyjmującą jako argumenty:login, hasło.
Abstrakcyjną metodę setLogin przyjmującą jako argument: login.
Abstrakcyjną metodę: setPassword, przyjmującą jako argument: hasło.
Publiczną finalną metodę login przyjmującą jako argumenty: username, password.
Metoda login sprawdza hasło za pomocą metody checkLogin.

Stwórz dwie klasy Client i Admin będące rozszerzeniami klasy User, w których zaimplementujesz metody abstrakcyjne.
W klasie Admin logowanie powinno spełniać następujące wymagania:
-Użytkownik podał prawidłowy login.
-Hasło miało minimum dziesięć znaków i było prawidłowe (warunek długości hasła sprawdź w metodzie setPassword)
W klasie Client logowanie powinno wymagać, aby:
-Użytkownik podał prawidłowy login.
-Hasło miało minimum osiem znaków i było prawidłowe (warunek długości hasła sprawdź w metodzie setPassword).

Stwórz obiekty każdej z klas i ustaw loginy oraz hasła. Sprawdź, czy logowanie działa. Logowanie powinno wymagać prawidłowego hasła i po trzech nieudanych próbach konto powinno być blokowane.
 */

abstract class User {

    protected $login;
    protected $password;
    protected $loginCount = 0;
    protected $passwordLength = 8;

    abstract function checkLogin($login, $password);

    abstract function setLogin($login);

    abstract function setPassword($password);

    final public function login($login, $password) {
        return $this->checkLogin($login, $password);
    }

}

class Client extends User {

    public function checkLogin($login, $password) {
        if ($this->loginCount == 3)
        {
            return false;
        }
        if ($this->login != $login) {
            return false;
        }
        if ($this->password != $password) {
            $this->loginCount++;
            return false;
        }
        $this->loginCount = 0;
        return true;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setPassword($password) {

        if (strlen($password) >= $this->passwordLength) {
            $this->password = $password;
            return true;
        }
        return false;

    }

}

class Admin extends Client {
    protected $passwordLength = 10;
}

$client = new Client();
$client->setLogin('Bartek');
$client->setPassword('12345678');
echo 'Client <br>';
var_dump($client->login('Bartek', '12345678'));

$admin = new Admin();
$admin->setLogin('Bartek');
$admin->setPassword('1234567890');
echo '<br> Admin 1<br>';
var_dump($admin->login('Bartek', '1'));
echo '<br> Admin 2<br>';
var_dump($admin->login('Bartek', '2'));
echo '<br> Admin 3<br>';
var_dump($admin->login('Bartek', '1234567890'));
echo '<br> Admin 4<br>';
var_dump($admin->login('Bartek', '4'));
echo '<br> Admin 5<br>';
var_dump($admin->login('Bartek', '5'));
echo '<br> Admin 6 <br>';
var_dump($admin->login('Bartek', '1234567890'));





//------------------------------

#Przykład 2:
/**
Stwórz klasę UserSet reprezentującą zbiór użytkowników klasy Client. Dla nowo stworzonej klasy zaimplementuj metodę add przyjmującą jako argument obiekt klasy Client. Zaimplementuj dla tej klasy interfejs Iterator, który spowoduje wyświetlenie loginów i haseł kolejnych użytkowników. Dodaj metodę checkLogin przyjmującą jako argument hasło i zwracającą wszystkich użytkowników mogących się zalogować danym hasłem – wykorzystaj pętlę foreach.

 */
//Na podstawie tego irteratora jest to robione - przerobiliśmy nieco kod
//php.net/manual/en/class.iterator.php

class UserSet implements Iterator
{
    private $position = 0;
    private $userSet = [];
    public function add(Client $client)
    {
        $this->userSet[] = $client;
    }
    public function showUsersWithPassword($password){
        //foreach($this->userSet as $key=>$value)
        //{$value->getLogin() . $value->getPassword()}
        foreach($this as $login=>$pass){
            if($password == $pass){
                echo $login . '<br>';
            }
        }
    }
    public function current() {
        return $this->userSet[$this->position]->getPassword() ;
    }

    public function key() {
        return $this->userSet[$this->position]->getLogin();
    }

    public function next() {
        ++$this->position;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function valid() {
        return isset($this->userSet[$this->position]);
    }

}


$user1 = new Client();
$user1->setLogin('Marek');
$user1->setPassword('1234567890');

$user2 = new Client();
$user2->setLogin('Maciek');
$user2->setPassword('tajnehaslo');

$user3 = new Client();
$user3->setLogin('Filip');
$user3->setPassword('tajnehaslo');

$userSet = new UserSet();
$userSet->add($user1);
$userSet->add($user2);
$userSet->add($user3);

$userSet->showUsersWithPassword('tajnehaslo');



//---------------------------------

#Przykład 3:

/**
Stwórz interfejs o nazwie Url służący do parsowania adresu url w celu uzyskania parametrów przekazanych metodą GET. Interfejs powinien zawierać konstruktor z jednym argumentem $url - adresem do sparsowania oraz metodę publiczną getParam($name), która w zamierzeniu ma zwrócić wartość parametru o nazwie $name wyciągnięty z $url.

Następnie stwórz klasę StandardUrl, w której zaimplementujesz interfejs. Jej zadaniem będzie sparsowanie standardowego url np. url_example.php?param1=99&param2=string w taki sposób żeby za pomocą metody getParam($param1) uzyskać 99 itp.

W momencie gdy klasa będzie działała prawidłowo utwórz plik url_example.php w którym zainkludujesz klasę z interfejsem. W pliku stwórz instancję obiektu StandardUrl przekazując w konstruktorze przykładowego urla (może być jak w przykładzie). Następnie wyświetl listę z nazwami wszystkich parametrów i ich wartościami.
 */

interface Url
{
    function __construct($url);
    function getParam($name);
}

class StandardUrl implements Url
{
    public $params;
    public function __construct($url) {
        //parse_url($url);
        $query = parse_url($url)['query'];
        parse_str($query, $result);
        $this->params = $result;

    }

    public function getParam($name) {
        if(isset($this->params[$name]))
        {
            return $this->params[$name];
        }
    }
}
$standardUrl = new StandardUrl('url_example.php?param1=99&param2=string');
echo $standardUrl->getParam('param1') . '<br>';
echo $standardUrl->getParam('param2') . '<br>';
echo $standardUrl->getParam('param3') . '<br>';