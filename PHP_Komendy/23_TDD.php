<?php
/*
W katalogu, w którym tworzymym projekt trzeba wgrać plik composer.json, który zawiera następujące linijki kodu:

--------composer.json----------
{
  "require-dev":{
    "phpunit/phpunit":"4.8.*"
  }
}
-------koniec composer.json-------

Następnie uruchamiamy terminal, wchodzimy do tego katalogu, gdzie jest plik composer.json i wpusujemy komendę:
composer install -vvv
Zaistaluje się nam wtedy katalog "vendor", w którym jest między innymi podkatalog "bin", a w nim plik phpunit.

W pliku, w którym jest testowany program powinniśmy najpierw dać komendę php:
require ('../../../vendor/autoload.php');

Testy przeprowadza się z konsoli wpisując:
../../../vendor/bin/phpunit nazwa_pliku.php


 */

#Przykład 1 - plik nazywa się zadanie1.php:
/*
W pliku zad1.php znajduje się funkcja, która przyjmuje liczbę całkowitą (oznaczającą rok) i zwraca true – jeżeli rok jest przestępny lub zwraca false jeżeli nie. Napisz testy do tej funkcji sprawdzając poprawność zwracanego typu i poprawność wskazań.
 */



require ('../../../vendor/autoload.php');

function is_year_leap($year = null) {

    if (isset($year)) {
        $leap = date('L', mktime(0, 0, 0, 1, 1, $year));
        echo $year . ' ' . ($leap ? 'is' : 'is not') . ' a leap year.' . "\n";
        return $leap;
    } else {
        return false;
    }
}

class Zadanie1 extends PHPUnit_Framework_TestCase
{
    public function test_no_year_given_returns_false()
    {
        $this->assertFalse(is_year_leap());
    }
    public function test_not_a_leap_year()
    {
        $this->assertEquals(0, is_year_leap(1));
        $this->assertEquals(0, is_year_leap(2));
        $this->assertEquals(0, is_year_leap(3));
        $this->assertEquals(0, is_year_leap(2200));

    }
    public function test_is_a_leap_year()
    {
        $this->assertEquals(1, is_year_leap(4));
        $this->assertEquals(1, is_year_leap(8));
        $this->assertEquals(1, is_year_leap(12));
        $this->assertEquals(1, is_year_leap(2000));
        $this->assertEquals(1, is_year_leap(2004));



    }

}

# W konsoli wtedy wpiszemy ../../../vendor/bin/phpunit zadanie1.php




