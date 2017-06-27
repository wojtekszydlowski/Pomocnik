<?php
/*
#Wyjątek (exception)
-Jest to mechanizm przepływu sterowania używany w mikroprocesorach oraz współczesnych językach programowania do obsługi zdarzeń wyjątkowych, w szczególności do obsługi błędów, których wystąpienie zmienia prawidłowy przebieg wykonywania programu.
-W momencie zajścia niespodziewanego zdarzenia generowany jest wyjątek, który musi zostać obsłużony poprzez zapamiętanie bieżącego stanu programu i przejście do procedury jego obsługi.

Innymi słowy:
-Wyjątek jest to mechanizm pozwalający obsłużyć sytuację wyjątkową, w której dalsze wykonywanie programu nie jest możliwe lub wskazane.
-Po zgłoszeniu wyjątku praca programu jest przerywana i następuje próba obsłużenia wyjątku.
-Jeżeli wyjątek nie zostanie obsłużony, to następuje koniec pracy programu i zgłaszany jest błąd nieobsłużonego wyjątku.


function inverse($x) {
  if (!$x) {
      throw new Exception('Division by zero.');
  }
  else return 1/$x;
}

try {
  $value = inverse(0);
} catch(Exception $e) {
  echo('Caught exception: ');
} finally {
  echo('First finally.');
}



#Rzucanie wyjątku:
-W PHP wyjątki są rzucane (throw).
-W momencie rzucenia wyjątku praca programu jest przerywana.
-Parametrem throw jest obiekt, który musi być klasy Exception (wbudowana klasa wyjątku) lub klasy po niej dziedziczącej.
-W klasie dziedziczącej po klasie Exception zawsze należy wywołać konstruktor klasy nadrzędnej.

class MyException extends Exception { }

class AdvException extends Exception {
  public function __construct($message = null, $code = 0)
   {
    parent::__construct($message, $code); //Wywołanie konstruktora klasy nadrzędnej.
   }
}




#Klasa Exception:
Exception {
//Właściwości
protected string $message;
protected int $code;
protected string $file;
protected int $line;
//Metody
public __construct ([ string $message = "" [, int $code = 0 [, Exception $previous = NULL ]]] )
final public string getMessage(void)
final public Exception getPrevious(void)
final public mixed getCode(void)
final public string getFile(void)
final public int getLine(void)
final public array getTrace(void)
final public string getTraceAsString(void)
public string __toString(void)
final private void __clone(void)
}



#Obsługa wyjątku
-Aby przechwycić rzucony wyjątek używamy bloku try....catch.
-W bloku try znajduje się kod, dla którego spodziewamy się wyjątków.
-W bloku catch znajduje się kod obsługi wyjątku.
-W jednym bloku try...catch może występować wiele bloków catch, które definiują różne sposoby obsługi różnych wyjątków.
-Do obsługi wyjątku wybierany jest pierwszy napotkany blok catch, który oczekuje wyjątku danego typu (danej klasy).


try {
   throw new TestException();
}
   catch(TestException $e) {  //Łapie tylko wyjątki z klasy TestException i jej pochodnych
     echo('Caught TestException');
}
   catch (Exception $e) {  //Łapie wszystkie wyjątki
    echo('Caught Exception');
}




#Zagnieżdżanie:
-Bloki try...catch mogą być zagnieżdżone jeden w drugim.
-Dany blok try...catch nie musi łapać wszystkich wyjątków.
-Może to zrobić któryś z bloków nadrzędnych.
-W bloku catch złapany wyjątek może być rzucony ponownie (rethrow) lub rzucony zupełnie nowy wyjątek.
-W takim wypadku obsługą wyjątku zajmą się nadrzędne bloki catch.

try {
  try {
    throw new MyException('foo!');
   } catch (MyException $e) {
     // rethrow it
      throw $e;
   }
} catch (Exception $e) {
    var_dump($e->getMessage());
}



#finally:
-Może się tak zdarzyć, że w bloku try przed rzuceniem wyjątku zostaną zaalokowane pewne zasoby wymagające zwolnienia nawet w przypadku wystąpienia wyjątku.
-Blok finally (od wersji PHP 5.5) jest wykonywany zawsze. Niezależnie od tego, czy został zgłoszony jakiś wyjątek czy nie.
-Umożliwia on zwolnienie takich zasobów (np. zamknięcie połączenia do bazy danych).

try {
  inverse(0);
} catch(Exception $e) {
   echo('Caught exception');
} finally {
echo('Finally.');
}





 */



#PRZYKŁADY:

/**
Zmień zadanie 1. z wyrażeń regularnych tak, żeby w przypadku niespełnienia odpowiedniego warunku – funkcja rzucała odpowiedni wyjątek. Następnie popraw formularz w taki sposób, żeby te wyjątki obsługiwał.
 *


function verifyPassword($password){
$isPasswordValid = true;
if(!(strlen($password) >= 10 && strlen($password) <= 15)){
$isPasswordValid = false;
echo $password."- haslo zbyt dlugie albo zbyt krotkie<br>";
}

$pattern = '/[a-z]+/';
if( (preg_match($pattern, $password, $matches) != 1)){
$isPasswordValid = false;
echo $password."-brak malej litery<br>";
}

$pattern = '/[A-Z]+/';
if( (preg_match($pattern, $password, $matches) != 1)){
$isPasswordValid = false;
echo $password."-brak duzej litery<br>";
}

$pattern = '/([a-z][a-z])|([A-Z][A-Z])/';
if( preg_match($pattern, $password, $matches) == 1){
//var_dump(preg_match($pattern, $password, $matches));
$isPasswordValid = false;
echo $password."-2 litery lub 2 litery duze nie moga byc kolo siebie<br>";
}

if( $isPasswordValid){
echo "password match<br>";
} else {
//echo "password no match";

}

}

verifyPassword("tBtB");
verifyPassword("AAAAAAAAAAA");
verifyPassword("a.a.a.a.a.a.a");
verifyPassword("AAaaBBaaAAbbAAbb");

 */

/*
Dodaje sobie z zad1.html formularz:
<form action="zadanie1.php" method="POST">
  <input type="text" placeholder="podaj hasło" name="password">
  <input type="submit"  value="wyślij hasło">
</form>
 */

class PasswordLengthException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}


class PasswordNoSmallLetterException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class PasswordNoBigLetterException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}


class PasswordTwoSameLetterException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

function verifyPassword($password){
    $isPasswordValid = true;

    $pattern = "/^.{10,15}$/";
    if (preg_match($pattern, $password, $matches) != 1) {
        throw new PasswordLengthException ($password. " - haslo zbyt dlugie albo zbyt krotkie<br>");
        $isPasswordValid =  false;
    };


    $pattern = '/[a-z]+/';
    if( (preg_match($pattern, $password, $matches) != 1)){
        $isPasswordValid = false;
        throw new PasswordNoSmallLetterException ($password." - brak malej litery<br>");
        //echo $password."-brak malej litery<br>";
    }

    $pattern = '/[A-Z]+/';
    if( (preg_match($pattern, $password, $matches) != 1)){
        $isPasswordValid = false;
        throw new PasswordNoBigLetterException ($password."-brak duzej litery<br>");
        //echo $password."-brak duzej litery<br>";
    }

    $pattern = '/([a-z][a-z])|([A-Z][A-Z])/';
    if( preg_match($pattern, $password, $matches) == 1){
        //var_dump(preg_match($pattern, $password, $matches));
        $isPasswordValid = false;
        throw new PasswordTwoSameLetterException ($password."-2 litery lub 2 litery duze nie moga byc kolo siebie<br>");
        //echo $password."-2 litery lub 2 litery duze nie moga byc kolo siebie<br>";
    }

    if( $isPasswordValid){
        echo "password match<br>";
    } else {
        //echo "password no match";

    }

}
/*
$subject = "abcdef";
$pattern = '/def$/';
preg_match($pattern, $subject, $matches);
var_dump($matches);
 *
 */

try {
    //Tutaj po kolei sobi ete testy odznaczam i sprawdzam po kolei każdy
    //verifyPassword("tBtB");
    //verifyPassword("AAAAAAAAAAA");
    //verifyPassword("a.a.a.a.a.a.a");
    //verifyPassword("AAaaBBaaAAbbAA");

    //albo - obsługa formularza z zadanie1.html
    if(isset($_POST['password']))
    {
        verifyPassword($_POST['password']);
    }
}

//Można każdy wyjątek z osobna
catch (PasswordLengthException $e)
{
    echo $e->getMessage();
}
catch (PasswordNoSmallLetterException $e)
{
    echo $e->getMessage();
}
catch (PasswordNoBigLetterException $e)
{
    echo $e->getMessage();
}
catch (PasswordTwoSameLetterException $e)
{
    echo $e->getMessage();
}

//Można wszystkie wyjątki w jednym (teraz zakomentowane):
//catch (Exception $e)
//{
//    echo $e->getMessage();
//}





#Zadanie 2:
/**
W pliku zadanie2.php znajduje się funkcja divide($divider, $dividend), która zwraca różne rodzaje wyjątków. Kolejna funkcja korzysta z niej w celu wyświetlenia wyniku dzielenia losowej liczby przez 5. Zmodyfikuj ją w ten sposób żeby nie przerywała swojego działania w chwili rzucenia wyjątku przez wykorzystywaną do dzielenia funckję divide(). Na koniec wyświetl informację na stronie ile razy wystąpi każdy z wyjątków.
 */

function divide($divider, $dividend) {

    if ($divider == 0){
        throw new InvalidArgumentException("Divide by zero error");
    }

    if ($divider < 0){
        throw new OutOfRangeException ("Divide is lower then zero");
    }

    return $dividend / $divider;

}

function randomDivide($tryNumber){

    $counterInvalidArgumentException = 0;
    $counterOutOfRangeException = 0;

    for ($n = 0; $n < $tryNumber; $n++){
        try {
            echo divide(rand(-10, 10) , 5) . '</br>';
        }
        catch (InvalidArgumentException $e) {
            $counterInvalidArgumentException++;
            //echo "counterInvalidArgumentException";
        }

        catch (OutOfRangeException $e) {
            $counterOutOfRangeException++;
            // echo "counterOutOfRangeException";
        }

    }

    echo 'count counterInvalidArgumentException = ' . $counterInvalidArgumentException . "<br>";
    echo 'count OutOfRangeException = ' . $counterOutOfRangeException . "<br>";

}

randomDivide (100);

//------------------------


#Zadanie 3:
/**
Napisz funkcję, która będzie losować liczby z przedziału -10 do 10. Napisz wyjątki tak, że jeśli zostanie wylosowana liczba 0 to wypisze na ekranie "Wylosowano 0", liczby ujemne będą wypisywane na czerwono, a gdy zostanie wylosowana liczba 10 zostanie uruchomiona funkcja SayHallo, która wypisze na ekranie "Hallo.

 */

function SayHallo () {
    echo "Hallo<br>";
}

class LowerThanZero extends Exception {
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}


class EqualTen extends Exception {
    public function __construct($message = "", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}

function randomNumber ($number){
    for ($a = 0; $a < $number; $a++) {
        try {
            $currentRandomNumber = rand(-10, 10);
            if ($currentRandomNumber < 0) {
                throw new LowerThanZero ("$currentRandomNumber");
            }

            if ($currentRandomNumber == 10) {
                throw new EqualTen ("$currentRandomNumber");
            }
            echo $currentRandomNumber . "<br>";

        }
        catch (LowerThanZero $e) {
            echo "<font color= \"red\">". $e->getMessage() . "</font><br>";
        }

        catch (EqualTen $e) {
            SayHallo ();
        }
    }
}

randomNumber(100);


//------------------------------------------

#Zadanie 4:

class customException extends Exception {
    public function errorMessage() {
        //error message
        $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
            .': <b>'.$this->getMessage().'</b> is not a valid E-Mail address';
        return $errorMsg;
    }
}

$email = "someone@example.com";

try {
    //check if
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        //throw exception if email is not valid
        throw new customException($email);
    }
    //check for "example" in mail address
    if(strpos($email, "example") !== FALSE) {
        throw new Exception("$email is an example e-mail");
    }
}

catch (customException $e) {
    echo $e->errorMessage();
}

catch(Exception $e) {
    echo $e->getMessage();
}