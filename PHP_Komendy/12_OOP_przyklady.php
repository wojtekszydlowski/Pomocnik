<?php
#Klasa Shape mająca funkcję liczącą odległość od innego obiektu klasy Shape
echo "------------------SHAPE--------------------<br>";
class Shape
{
    private $x;
    private $y;
    private $color;

    public function __construct($x, $y, $color)
    {
        $this->x = is_numeric ($x) ? $x : 0;
        $this->y = is_numeric ($y) ? $y : 0;
        $this->color = is_string($color) ? $color : '';

        echo "SHAPE CREATED : " . $this->x . ", " . $this->y . ", " . $this->color . "<br>";

    }

    public function printInfo($pretty = false)
    {
        echo "YOUR SHAPE IS: " . $this->x . ", " . $this->y . ", " . $this->color . "<br>";
    }


    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }



    public function distanceToShape (Shape $otherShape) //Shape w nawiasie powoduje, że mogę jako argument podać tylko instancję (element z)  klasy Shape - to takie zabezpieczenie, żeby nie podawać złych typów danych jako argument wywołania metody (funckji) - to jest dobra praktyka
    {
        return $this->distanceToPoint($otherShape->getX(), $otherShape->getY());
        //lub - to wcześniejsza wersja
        //return sqrt ( //sqrt - pierwiastek kwadratowy, pow - potęga
        //  pow($this->x - $otherShape->getX(),2) +
        //pow ($this->y - $otherShape->getY(),2)
        //);

    }

    public function distanceToShape2 ($x, $y){ //inna sposób
        $distance = sqrt ( pow ($this->x - $x, 2) + pow ($this->y - $y, 2));
        return $distance;

    }

    public function distanceToPoint ($x, $y)  //dodatkowe zadanie - liczy odległość do dowlnego punktu
    {
        return sqrt ( //sqrt - pierwiastek kwadratowy, pow - potęga
            pow ($this->x - $x,2) +
            pow ($this->y - $y,2)
        );
    }

}

$shape = new Shape(1,1,'red');
// $shape = null - tu wywołuje się niszczenie destruktora
$shape2 = new Shape(2,2,'blue');
$shape->printInfo();
var_dump($shape->distanceToShape($shape2));
var_dump($shape->distanceToPoint(1,4));
$dystans = $shape->distanceToShape2(2,3); // wywołanie dla tego drugiego sposobu

echo "--------------KONIEC SHAPE------------<br><br>";



echo "------------------BANK ACCOUNT---------------<br>";
/*
Stwórz klasę BankAccount, która ma spełniać następujące wymogi:

    Mieć prywatne atrybuty:
        number - atrybut ten powinien trzymać numer identyfikacyjny konta (dla uproszczenia możemy założyć że numerem konta może być dowolna liczba całkowita),
        cash - atrybut określający ilość pieniędzy na koncie. Ma to być liczba zmiennoprzecinkowa.
    Posiadać konstruktor przyjmujący tylko numer konta. Atrybut cash powinien być zawsze nastawiany na 0 dla nowo tworzonego konta.
    Posiadać getery do atrybutów number i cash, ale NIE posiadać do nich seterów (nie chcemy żeby raz stworzone konto mogło zmienić swój numer, a do atrybuty cash dodamy specjalne funkcje modyfikujące jej wartość).
    Posiadać metodę 'depositCash($amount)' której rolą będzie zwiększenie wartości atrybutu cash o podaną wartość. Pamiętaj o sprawdzeniu czy podana wartość jest:
        Wartością numeryczną,
        Większa od 0
    Posiadać metodę 'withdrawCash($amount)' której rolą będzie zmniejszenie wartości atrybutu cash o podaną wartość. Metoda ta powinna zwracać ilość wypłaconych pieniędzy. Dla uproszczenia zakładamy że ilość pieniędzy na koncie nie może zejść poniżej 0, np. jeżeli z konta na którym jest 300zł próbujemy wypłacić 500zł to metoda zwróci nam tylko 300zł. Pamiętaj o sprawdzeniu czy podana wartość jest:
        Wartością numeryczną,
        Większa od 0
    Posiadać metodę printInfo nie przyjmującą żadnych parametrów. Metoda ta ma wyświetlić informację o numerze konta i jego stanie.

 */

class BankAccount
{
    private $number;
    private $cash = 0.0;

    /**
     * BankAccount constructor.
     * @param $number
     */
    public function __construct($number)
    {
        $this->number = is_int($number) ? $number : 0;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return float
     */
    public function getCash()
    {
        return $this->cash;
    }

    public function depositCash($amount)
    {
        //Pierwsza wersja - w komentarzu
        //if (is_numeric($amount) && $amount > 0){
        //  $this->cash += $amount; // $this->cash = $this->cash + $amount;
        //}
        if ($this->canBeDeposited($amount)) {
            $this->cash += $amount;
        }
    }

    private function canBeDeposited($amount)
    {
        return is_numeric($amount) && $amount > 0;
    }

    public function withdrawCash($amount)
    {
        if ($this->canBeWithdrawed($amount)) {
            $this->cash -= $amount;
        }

    }

    private function canBeWithdrawed($amount)
    {
        return is_numeric($amount) && $amount > 0 && $amount <= $this->cash;
    }

    public function printInfo()
    {
        var_dump($this);
    }
}
$account = new BankAccount('1234567890');
$account2 = new BankAccount('2123456780');
$account->depositCash(10);
$account->depositCash(20);

$account->withdrawCash(10);

$account->printInfo();
$account2->printInfo();


echo "------------------ KONIEC BANK ACCOUNT---------------<br>";