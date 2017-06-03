<?php
#PRZYKŁADY:

/**
W pliku zad1.php znajduje się funkcja, która przyjmuje liczbę całkowitą (oznaczającą rok) i zwraca true – jeżeli rok jest przestępny lub zwraca false jeżeli nie. Napisz testy do tej funkcji sprawdzając poprawność zwracanego typu i poprawność wskazań.

function is_year_leap($year = null) {

    if (isset($year)) {
        $leap = date('L', mktime(0, 0, 0, 1, 1, $year));
        echo $year . ' ' . ($leap ? 'is' : 'is not') . ' a leap year.';
        return $leap;
    } else {
        return false;
    }
}

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



//------------------------------------------


/**
W pliku z zadaniem zad2.php znajduje się kod realizujący poniższe zadanie.
Napisz funkcję zamieniającą liczbę na zapis słowny tej liczby. Np. 143 zamieni na „sto czterdzieści trzy”. Liczby mają być w zakresie do tysiąca (ale bez tysiąca). Do tej funkcji należy zaprojektować testy, które zdiagnozują błąd. Podstawowe trzy przypadki testowe to:

    sprawdzanie liczby mniejszej od 10
    liczba większa od 10 ale mniejsza od 20
    powyżej 100

Popraw kod po napisaniu testów.
 */


function numToTxt($number) {

    if (!is_int($number) || $number < 1 || $number > 999) {
        echo "Insert number from 1 to 999";
        return false;
    }

    $lengthNum = strlen(strval($number));

    if ($lengthNum == 3) {
        $hundreds = substr($number, 0, 1);
        $tens = substr($number, 1, 1);
        $ones = substr($number, 2, 3);
    }
    if ($lengthNum == 2) {
        $tens = substr($number, 0, 1);
        $ones = substr($number, 1, 1);
        $hundreds = 0;
    }
    if ($lengthNum == 1) {
        $ones = substr($number, 0, 1);
        $hundreds = 0;
        $tens = 0;
    }


    $numsOnes = ['', 'jeden', 'dwa', 'trzy', 'cztery', 'pięć', 'sześć', 'siedem', 'osiem', 'dziewięć'];
    $numsHundreds = ['', 'sto', 'dwieście', 'trzysta', 'czterysta', 'pięćset', 'sześćset', 'siedemset', 'osiemset', 'dziewięćset'];
    $numsTens = ['', 'dziesięc', 'dwadzieścia', 'trzydzieści', 'czterydzieści', 'pięćdziesiąt', 'sześćdziesiąt', 'siedemdziesiąt', 'osiemdziesiąt', 'dziewięćdziesiąt'];
    $part1 = $numsHundreds[$hundreds];
    $part2 = $numsTens[$tens];

    $part3 = $numsOnes[$ones];

    if ($hundreds == 0) {
        $part1 = '';
    }
    if ($tens == 0) {
        $part2 = '';
    }
    if ($ones == 0) {
        $part3 = '';
    }
    if ($tens == 1) {
        $part3 = '';

        switch($ones) {
            case 0:
                $part2 = " dziesięć";
                break;
            case 1:
                $part2 = " jedenaście";
                break;
            case 2:
                $part2 = " dwanaście";
                break;
            case 3:
                $part2 = " trzynaście";
                break;
            case 4:
                $part2 = " czternaście";
                break;
            case 5:
                $part2 = " piętnaście";
                break;
            case 6:
                $part2 = " szesnaście";
                break;
            case 7:
                $part2 = " siedemnaście";
                break;
            case 8:
                $part2 = " osiemnaście";
                break;
            case 9:
                $part2 = " dziewiętnaście";
        }
    }

    return trim($sum = $part1 .' '. $part2 .' '. $part3);
}



class Zadanie2Test extends PHPUnit_Framework_TestCase
{

    public function test_numbers_smaller_than_10()
    {
        $this->assertEquals("jeden", numToTxt(1));
        $this->assertEquals("dwa", numToTxt(2));
        $this->assertEquals("trzy", numToTxt(3));
        $this->assertEquals("cztery", numToTxt(4));
        $this->assertEquals("pięć", numToTxt(5));
        $this->assertEquals("sześć", numToTxt(6));
        $this->assertEquals("siedem", numToTxt(7));
        $this->assertEquals("osiem", numToTxt(8));
        $this->assertEquals("dziewięć", numToTxt(9));
    }

    public function test_number_between_10_and_20()
    {
        $this->assertEquals("dziesięć", numToTxt(10));
        $this->assertEquals("jedenaście", numToTxt(11));
        $this->assertEquals("dwanaście", numToTxt(12));
        $this->assertEquals("trzynaście", numToTxt(13));
        $this->assertEquals("czternaście", numToTxt(14));
        $this->assertEquals("piętnaście", numToTxt(15));
        $this->assertEquals("szesnaście", numToTxt(16));
        $this->assertEquals("siedemnaście", numToTxt(17));
        $this->assertEquals("osiemnaście", numToTxt(18));
        $this->assertEquals("dziewiętnaście", numToTxt(19));
        $this->assertEquals("dwadzieścia", numToTxt(20));
    }

    public function test_number_whole_tens_30_and_90()
    {
        $this->assertEquals("trzydzieści", numToTxt(30));
        $this->assertEquals("czterdzieści", numToTxt(40));
        $this->assertEquals("pięćdziesiąt", numToTxt(50));
        $this->assertEquals("sześćdziesiąt", numToTxt(60));
        $this->assertEquals("siedemdziesiąt", numToTxt(70));
        $this->assertEquals("dwieście jeden", numToTxt(201));
    }


}




//---------------------------------

/**
W pliku z zad3.php jest funkcja przyjmująca liczbę całkowitą jako parametr oraz zwracająca liczby od 1 do podanej liczby, korzystając dodatkowo z poniższych założeń:

w miejsce liczb podzielnych przez 3 wypisuje Fizz,
w miejsce liczb podzielnych przez 5 wypisuje Buzz,
w miejsce liczb podzielnych przez 3 i 5 wypisuje BuzzFizz.

Napisz test dla każdego z trzech powyższych założeń sprawdzając czy zwracana jest prawidłowa wartość.
 */

require ('../../../vendor/autoload.php');
function fizzBuzz($number) {

    if (!is_integer($number)) {
        echo "Not an integer";
    }

    $output = '';

    for ($i = 1; $i <= $number; $i++) {
        if ($i % 3 == 0 && $i % 5 == 0) {
            $output .= 'BuzzFizz';
        } else if ($i % 3 == 0) {
            $output .= 'Fizz';
        } else if ($i % 5 == 0) {
            $output .= 'Buzz';
        } else {
            $output .= $i;
        }
    }

    return $output;

}


echo fizzBuzz(5);



class Zadanie3Test extends PHPUnit_Framework_TestCase
{

    public function testFizzBuzz()
    {
        $this->assertEquals("12Fizz4Buzz", fizzBuzz(5));
        $this->assertEquals("12Fizz4BuzzFizz78FizzBuzz11Fizz13", fizzBuzz(13));

    }
}



//----------------------------

/**
 W pliku zad4.php znajduje się klasa kalkulatora oraz metody realizujące działania matematyczne. Dopisz testy do każdej z metod matematycznych sprawdzając różne argumenty oraz poprawność zwracanych wyników. W przypadku konieczności zmodyfikuj kod aby zwracał poprawne wartości.
 */

require ('../../../vendor/autoload.php');

class Calculator {
    public $operationHistory = [];

    public function __construct() {

    }

    public function add($num1,$num2) {
        $result = $num1 + $num2;
        $this->addOperationHistory("added $num1 to $num2 got $result");
        return $result;
    }
    public function multiply($num1,$num2) {
        $result = $num1 * $num2;
        $this->addOperationHistory("multiplied $num1 to $num2 got $result");
        return $result;
    }

    public function subtract($num1,$num2) {
        $result = $num1 - $num2;
        $this->operationHistory[] = "subtracted $num2 to $num1 got $result";
        return $result;
    }

    //funkcja przyjmuje tablicę
    public function multiplyMany($numbers) {
        $result = 1;
        foreach ($numbers as $number) {
            $result *= $number;
        }
        return $result;
    }

    public function divide($num1,$num2) {
        if ($num2 == 0) {
            echo "Błąd dzielenia przez 0!";
            return null;
        }
        $result = $num1 / $num2;
        $this->operationHistory[] = "divided $num1 to $num2 got $result";
        return $result;
    }

    public function printOperations() {
        foreach ($this->operationHistory as $operation) {
            echo $operation . "<br>";
        }
        return $this;
    }
    public function clearOperations() {
        $this->operationHistory = [];
        echo "Operacje wyczyszczone";
    }

    protected function addOperationHistory($operation) {
        $this->operationHistory[] = $operation;
    }

    public function multiplyAnyAndAdd($numbers,$numberToAdd) {
        $temp = $this->multiplyMany($numbers);
        $result = $this->add($temp,$numberToAdd);
        return $result;
    }
}



//Rozwiązanie zadania:
class CalculatorTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->object = new Calculator;
    }

    public function testCalculatorExists()
    {
        $this->assertNotEmpty($this->object);
    }

    public function testAdd()
    {
        $this->assertEquals(0, $this->object->add(0, 0));
        $this->assertEquals(-1, $this->object->add(-1, 0));
        $this->assertEquals(1, $this->object->add(0, 1));
        $this->assertEquals(2, $this->object->add(1, 1));
        $this->assertEquals(3, $this->object->add(2, 1));
        $this->assertEquals(3, $this->object->add(1, 2));
    }

    public function testMultiply()
    {
        $this->assertEquals(0, $this->object->multiply(0, 0));
        $this->assertEquals(1, $this->object->multiply(1, 1));
        $this->assertEquals(4, $this->object->multiply(2, 2));

    }

    public function testSubtract()
    {
        $this->assertEquals(0, $this->object->subtract(1, 1));

    }

    public function testMultiplyMany()
    {
        $this->assertEquals(2, $this->object->multiplyMany([1, 2]));
    }

    public function testDivide()
    {
        $this->assertNull($this->object->divide(1, 0));
        $this->assertEquals(1, $this->object->divide(1, 1));
    }

    public function testPrintOperationsReturnsSelf()
    {
        $this->assertEquals($this->object, $this->object->printOperations());
    }

    public function testPrintOperationsAdd()
    {
        $this->object->add(1, 1);
        $this->assertEquals($this->object, $this->object->printOperations());
        $this->assertEquals("added 1 to 1 got 2", $this->object->operationHistory[0]);
    }

    public function testClearOperations()
    {
        $this->assertEmpty($this->object->operationHistory);
        $this->object->add(1, 1);
        $this->assertNotEmpty($this->object->operationHistory);
        $this->object->clearOperations();
        $this->assertEmpty($this->object->operationHistory);
    }

    public function testMultiplyAnyAndAdd()
    {
        $this->assertEquals(0, $this->object->multiplyAnyAndAdd([0], 0));
    }
}


//--------------------------------------------


/**
BankAccount - klasa, która realizuje funkcjonalność konta bankowego znajduje się w pliku zad5.php. Przeanalizuj działanie kodu oraz napisz następujące testy:

    Test sprawdzający konstruktor. Test powinien sprawdzić czy atrybut cash jest wyzerowany.
    Test do metody depositCash($amount) sprawdzający działanie w przypadku różnych nieprawidłowych typów argumentu oraz wartości.
    Test do metody withdrawtCash($amount) w przypadku podania większej kwoty niż ta zapisana w atrybucie $cash.
    Test do metody printInfo, która ma zwrócić wartość prywatnego atrybutu $cash.

Czy udało się zlokalizować błąd/błędy ?
 */

require ('../../../vendor/autoload.php');

class BankAccount {
    private $number;
    private $cash;
    static private $nextAccNumber = 1;

    public function __construct() {
        $this->number = self::$nextAccNumber;
        self::$nextAccNumber++;
        $this->cash = 0.0;
        echo "Twój numer konta: $this->number.<br>";
    }

    public function getNumber() {
        return $this->number;
    }

    public function getCash() {
        return $this->cash;
    }

    public function depositCash($amount) {
        if (is_numeric($amount) && $amount > 0) {
            $this->cash += $amount;
        }
        return $this;
    }

    public function withdrawCash($amount) {
        if (is_numeric($amount) && $amount > 0) {
            if ($amount > $this->cash) {
                $withdraw = $this->cash;
            }
            else {
                $withdraw = $amount;
            }
            $this->cash -= $withdraw;
            return $withdraw;
        }
    }

    public function printInfo() {
        echo $this->cash;
    }
}


//Rozwiązanie:

class TestBankAccount extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->object = new BankAccount;
    }

    public function testObjectExists()
    {
        $this->assertNotEmpty($this->object);
    }

    public function testCashIsZero()
    {
        $this->assertEquals(0, $this->object->getCash());
    }

    public function testDepositCashNoErrors()
    {
        $this->object->depositCash(10);
        $this->assertEquals(10, $this->object->getCash());

        $this->object->depositCash(1.1);
        $this->assertEquals(11.1, $this->object->getCash());
    }

    public function testDepositCashInvalidArgument()
    {
        $this->object->depositCash(true);
        $this->object->depositCash(false);
        $this->object->depositCash([100]);
        $this->object->depositCash($this->object);
        $this->object->depositCash(-100);
        $this->object->depositCash(-0.000001);

        $this->assertEquals(0, $this->object->getCash());
    }

    public function testWithdrawCashInvalidArgument()
    {
        $this->assertEquals( null, $this->object->withdrawCash(-200));

    }

    public function testWithdrawCashMoreThanWeGot()
    {
        $this->object->depositCash(10);
        $this->assertEquals(10 , $this->object->withdrawCash(200));

    }

    public function testWithdrawCashOK()
    {
        $this->object->depositCash(10);
        $this->assertEquals(9, $this->object->withdrawCash(9));
        $this->assertEquals(1, $this->object->getCash());

    }

    public function testPrintInfo()
    {

    }
}



//--------------------------------------------


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


//------------------------------


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


