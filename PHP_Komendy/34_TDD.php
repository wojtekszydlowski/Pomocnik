<?php
/*
#Co to jest TDD?:
Test driven development (TDD) jest techniką tworzenia oprogramowania zaliczaną do metodyk zwinnych (Agile).
Polega na wielokrotnym powtarzaniu trzech kroków:
-napisaniu testu automatycznego,
-implementacji funkcjonalności do chwili, gdy wszystkie testy przejdą,
-poprawiania kodu do momentu, w którym spełnia wszystkie wymagania (a testy nadal przechodzą).

---

#Zalety i wady TDD:

1.Zalety:
-Szybkie wychwytywanie błędów (już na etapie początkowej implementacji logiki).
-Błędy wykrywane i naprawiane przez autora są tańsze w naprawie.
-Kod tworzony za pomocą TDD jest bardziej przejrzysty i łatwiejszy w utrzymaniu.
-Możliwość testowania aplikacji bez potrzeby uruchamiania całego programu.

2.Wady:
-Deweloper potrzebuje dodatkowego czasu przeznaczonego na tworzenie testów.
-Rozpoczęcie pracy nad kodem jest przesunięte w czasie.
-Testy muszą być odpowiednio zarządzane i uaktualniane wraz ze zmianą logiki. Inaczej TDD traci sens.

---

#Cztery złote zasady TDD:
-Dodawaj kod, gdy czerwone.
-Usuwaj kod, gdy zielone.
-Usuwaj duplikaty.
-Poprawiaj złe nazwy.

---

#Metoda Spike:
Krok 1: Brzydko napisz kod metodą prób i błędów.
Krok 2: Gdy już wiesz, jak rozwiązać problem, usuń kod i zrób to porządnie.

---

#Kiedy nasze testy są dobre?

Testy można uznać za dobrze napisane, gdy są:
-Niezależne (od środowiska i innych testów).
-Szybkie (dzięki temu mogą być wykorzystane w Continuous Integration).
-Powtarzalne (za każdym razem dają takie same wyniki).
-Na bieżąco z kodem (zawsze, gdy zmienia się funkcjonalność, muszą zmienić się testy).
-Krótkie
-Odporne na zmiany (innych części naszej aplikacji)

*/


//PRZYKŁADY:

/**
Napisz klasę User implementującą następujące funkcjonalności:

Rejestracje użytkownika.
Logowanie.
Edycję danych (łącznie ze zmianą hasła).
Dane niech będą zapisywane do sesji.

Napisz to zadanie, używając w pełni metodologii TDD.
 */

require ('../../../vendor/autoload.php');

class User
{
    public function register ($login, $password)
    {
        if (!empty($login) && !empty($password)) {
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            return true;
        }
        else {
            return false;
        }
    }

    public function login ($login, $password)
    {
        if ($_SESSION['login'] === $login && $_SESSION['password'] === $password) {
            return true;
        }
        else {
            return false;
        }
    }

    public function editLogin ($newLogin)
    {
        if (!empty($newLogin)) {
            $_SESSION['login'] = $newLogin;
            return true;
        }
        else {
            return false;
        }
    }

    public function editPassword ($newPassword)
    {
        if (!empty($newPassword)) {
            $_SESSION['password'] = $newPassword;
            return true;
        }
        else {
            return false;
        }
    }

}


//TESTY:


class UserTest extends PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        $this->object = new User;
        $this->login = 'Pawel';
        $this->password = 'Password';
        $this->newPassword = 'NewPassword';
    }

    public function testUserRegistrationOK()
    {

        $this->assertTrue($this->object->register($this->login, $this->password));
    }

    public function testUserRegistrationMissingLogin()
    {
        $login = '';
        $password = 'Password';
        $this->assertFalse($this->object->register($login, $password));
    }

    public function testUserRegistrationMissingPassword()
    {
        $login = 'Pawel';
        $password = '';
        $this->assertFalse($this->object->register($login, $password));
    }

    public function testLoginOK()
    {

        $this->object->register($this->login, $this->password);
        $this->assertTrue($this->object->login($this->login, $this->password));
    }

    public function testLoginWrongPassword()
    {

        $wrongPassword = '123';
        $this->object->register($this->login, $this->password);
        $this->assertFalse($this->object->login($this->login, $wrongPassword));
    }

    protected function preEditPassword()
    {

        $this->object->register($this->login, $this->password);
    }

    public function testEditPasswordOK()
    {
        $newPassword = 'NewPassword';
        $this->preEditPassword();
        $this->assertTrue($this->object->editPassword($newPassword));
    }

    public function testLoginWithNewPasswordOK()
    {
        $newPassword = 'NewPassword';
        $this->preEditPassword();
        $this->assertTrue($this->object->editPassword($newPassword));
        $this->assertTrue($this->object->login($this->login, $newPassword));
    }
}



//---------------------------

/**
Napisz klasę mającą jedną statyczną metodę generatePrimeFactors($n), która wygeneruje wszystkie dzielniki podanej liczby n w kolejności numerycznej (od najmniejszego). Do tego zadania użyj w pełni metodologii TDD. Wykonuj commit po każdy z 3 etapów procesu czyli:

po napisaniu testów
po napisaniu kodu
po refaktoryzacji

*/


class PrimeNumbers
{
    static public function generatePrimeFactors($n)
    {
        $primeFactors = [];
        for ($i=1;$i<=$n;$i++) {
            if (($n % $i) == 0) {$primeFactors[]=$i;}
        }
        return $primeFactors;
    }

}


//$myPrimeNumber = new PrimeNumbers();
var_dump(PrimeNumbers::generatePrimeFactors(78));



class PrimeNumbersTest extends PHPUnit_Framework_TestCase
{
    public function testNumberOfElementsInArray()
    {
        $this->assertCount(8, PrimeNumbers::generatePrimeFactors(78));
    }

    public function testArray()
    {
        $this->assertEquals([1,2,3,6,13,26,39,78], PrimeNumbers::generatePrimeFactors(78));
    }

}