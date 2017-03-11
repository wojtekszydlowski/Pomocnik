<?php
/*
Dziedziczenie - na podstawie kalkulatora

extends - dziedziczenie po klasie np. class AdvancedCalculator extends Calculator
const - atrybut, który nie może być zmieniony podczas działania naszej aplikacji, aby go wywołać należy dać self::nazwa_tego_atrybutu

static - jeżeli dodamy słowo kluczowe static do atrybutu, to tworzymy zmienną, która jest współdzielona przez wszystkie obiekty danej klasy.
Na przykład: static public $aNum = 0;
Z wnętrza klasy możemy się odnieść do takiej zmiennej przez konstrukcję:
self::$nazwa_zmiennej np. return self::PI * $r * $r;
Z innych miejsc w kodzie przez:
Nazwa_Klasy::$nazwa_zmiennej np. AdvancedCalculator::computeCircleRadius(10)


*/


require_once '13_OOP_Calculator.php';

class AdvancedCalculator extends Calculator
{

    const PI = 3.14;

    public static function computeCircleRadius($r)
    {
        return self::PI * $r * $r;
        //return self::PI * $r ** 2; - alternatywna wersja 1
        //return self::PI * pow($r,2); - alternatywna wersja 2

    }

    public function pow ($num1, $num2)
    {
        $result = $num1 ** $num2;  //podnosi do potęgi num2 liczbę num1
        //$result = pow ($num1, $num2); - druga metoda podnoszenia do potęgi

        $this->log('pow', $num1, $num2, $result);
        return $result;
    }

    public function root ($num1, $num2)
    {
        $result = pow ($num1,1 /  $num2);
        $this->log('root', $num1, $num2, $result);
        return $result;

    }
}
$advCal = new AdvancedCalculator();
var_dump(AdvancedCalculator::computeCircleRadius(10));
$advCal->pow(-2,3);
$advCal->add(1,1);
$advCal->root(9,2);
$advCal->printOperations();

#Funkcja computeCircleRadius nie może używać funkcji log - tu nie ma obiektu i $this - nie można wywoływać metod z obiektu, które są statyczne


#-----------------------------
#Wykorzystanie konskruktora z klasy rodzica np. parent::__construct($x, $y, $color);
require_once ('Shape2.php');


class Circle extends Shape
{
    private $r;

    public function __construct($x, $y, $color, $r)
    {
        parent::__construct($x, $y, $color);

        $this->r = $r;

        echo 'CIRCLE CREATED: ' . $this->r . PHP_EOL;
    }
}

#-----------------------------
#Wykorzystanie metody z rodzica - method overwriting - służy to stworzeniu nowej funkcjonalności dla klasy podrzędnej, która ma być wywołana przez funkcję o tej samej nazwie co w klasie nadrzędnej. Jeżeli chcemy wykorzystać funkcję klasy nadrzędnej, możemy się do niej odwołać przez słowo kluczowe parent::

public function printInfo ()
{
    return 'CIRLCE DETAILS: ' . $this->r . ' ( ' . parent::printInfo() . ' )' . '<br>';
}

#-----------------------------
#Wykorzystanie geta
class Employee
{
    protected $id;
    protected $firstName;
    protected $lastName;
    private $salary;

    public function getSalary()
    {
        return $this->salary;
    }
}

class HourlyEmployee extends Employee
{
    public function computerPayment ($hours)
    {
        return $this->getSalary() * $hours; //podstawiamy jako geta zmienną z klasy rodzica

    }
}

$employee = new HourlyEmployee(1, 'John', 'Kovalsky', 100);
$paymentForHours = $employee->computerPayment(3);
echo $paymentForHours;

#-----------------------------
