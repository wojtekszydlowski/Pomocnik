<?php
/**
Napisz obiektowo program, który będzie obsługiwał skanowanie produktów w sklepie.

Stwórz klasę 'Product'. Klasa ta ma posiadać podane atrybuty:
id - liczba całkowita. Powinna być unikalna w całym systemie (jak to osiągnąć będzie wytłumaczone w dalszej części zadania).
name - string. Jest to nazwa danego produktu.
description - string. Jest to opis danego produktu.
price - float. Jest to cena za jeden produkt. Powinna być większa od 0.01.
quantity - liczba całkowita większa od zera.

Klasa powinna mieć też następujące metody:
konstruktor - powinien przyjmować opis, cenę i ilość produktu.
setery dla następujących atrybutów: opisu, nazwy, ceny i ilości. Nie piszemy setera dla identyfikatora produktu - nie chcemy żeby raz stworzony produkt mógł zmienić swoje id.
getery dla wszystkich atrybutów.
metodę getTotalSum która będzie zwracała łączną kwotę za dany produkt (wyliczaną jako ilość * cena produktu.
Generowanie unikalnego id dla produktu:

W dalszej części programu będziemy chcieli identyfikować nasze produkty po ich id. Dlatego musimy zagwarantować że każdy z stworzonych produktów będzie miał unikalny numer identyfikacyjny. W tym celu nasza klasa powinna mieć statyczny prywatny atrybut nextId:

static priveate $nextId = 0;

Atrybut ten będzie trzymał id które zostanie nadane następnemu stworzonemu produktowi. Następnie w konstruktorze klasy musimy wykonać następujące czynności:
właśnie tworzonemu produktowi przypisać id trzymane w statycznym atrybucie nextId,
zwiększyć wartość atrybutu nextId o jeden.

// w konstruktorze
$this->id = self::$nextId;
self::$nextId++;

Dzięki temu żaden z naszych produktów nie będzie miał takiego samego id.
 */

class Product
{
    private $id = 0;
    static private $nextId = 0;
    private $name = "";
    private $description = "";
    private $price = 0.0;
    private $quantity = 1;

    /**
     * Product constructor.
     * @param string $name
     * @param string $description
     * @param float $price
     * @param int $quantity
     */
    public function __construct($name, $description, $price, $quantity)
    {
        $this->id = self::$nextId;
        self::$nextId++;
        $this->name = is_string($name) ? $name : "";
        $this->description = is_string($description) ? $description : "";
        $this->price = (is_numeric($price) && ($price > 0.01)) ? $price : 0.01;
        $this->quantity = (is_integer($quantity) && $quantity > 0) ? $quantity : 1;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    //public static function getId()
    public function getId()
    {
        //return self::$id;
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }



    public function getTotalSum()
    {
        return $this->price * $this->quantity;
    }

    static public function getTotalSumWithQuantity($price, $quantity)
    {
        if ($quantity > 2) {return $price * 0.8 * $quantity;} else {return $price * $quantity;}

    }

}


/**
Napisz klasę ShoppingCart. Klasa ta ma posiadać podane atrybuty:

products - tablica z obiektami klasy Product.

Klasa powinna mieć też następujące metody:

addProduct(product $newProduct) - metoda ta powinna dodawać nowy produkt do tablicy z produktami. Kluczem produktu powinno być jego id (dzięki temu będziemy mogli łatwo znaleźć produkt w naszym koszyku).
removeProduct($productId) - metoda ta powinna usuwać produkt z koszyka. Jeśli taki produkt nie był wcześniej zeskanowany, to ma nic nie robić.
changeProductQuantity($productId, $newQuantity) - metoda ta powinna zmieniać ilość danego produktu w koszyku. Jeśli taki produkt nie był wcześniej zeskanowany, to ma nic nie robić.
printRecipt() - metoda drukująca paragon. Na paragonie powinno się znaleźć: lista wszystkich produktów, wraz z ich id, nazwą, ceną, ilością i łączą ceną (pamiętaj że masz do tego dedykowaną metodę w klasie Product) i łączna kwota za wszystkie produkty znajdujące się w koszyku.

 */

//require_once ("Product.php");

class ShoppingCart
{
    public $products = [];

    public function addProduct (Product $newProduct)
    {
        $this->products[] = $newProduct; //dodaje do tablicy cały obiekt - nie potrzeba wtedy później używać referencji
    }



    public function removeProduct($productId)
    {
        foreach ($this->products as $keyToDelete => $oneLine) //trzeba ustawić klucz, żeby było wiadomo który obiektu usunąć z tablicy
        {
            if ($oneLine->getId() == $productId)
            {
                unset($this->products[$keyToDelete]);
            }
        }

    }

    public function changeProductQuantity($productId, $newQuantity)
    {

        foreach ($this->products as $oneLine)
        {
            if ($oneLine->getId() == $productId)
            {
                $oneLine->setQuantity($newQuantity);
            }
        }


    }

    public function printRecipt()
    {
        echo "<table border=1><tr>";
        echo "<td>ID</td>";
        echo "<td>Name</td>";
        echo "<td>Description</td>";
        echo "<td>Price per item</td>";
        echo "<td>Quantity</td>";
        echo "<td>Total price</td>";
        echo "</tr>";
        $totalAmountToPay = 0;
        foreach ($this->products as $oneLine) {
            echo "<tr>";

            echo "<td>" . $oneLine->getId() . "</td>";
            echo "<td>" . $oneLine->getName() . "</td>";
            echo "<td>" . $oneLine->getDescription() . "</td>";
            echo "<td>" . number_format($oneLine->getPrice(), 2, ',', ' ') . "</td>";
            echo "<td>" . $oneLine->getQuantity() . "</td>";
            $totalAmountToPay += Product::getTotalSumWithQuantity($oneLine->getPrice(),$oneLine->getQuantity());
            echo "<td>" . number_format(Product::getTotalSumWithQuantity($oneLine->getPrice(),$oneLine->getQuantity()), 2, ',', ' ') . "</td>";

            echo "</tr>";
        }

        echo "<tr><td></td><td></td><td></td><td></td>";
        echo "<td><strong>Total:</strong></td>";
        echo "<td>";

        echo "<strong>" . number_format($totalAmountToPay, 2, ',', ' ') ."</strong>";

        echo "</td>";
        echo "</tr>";

        echo "</table>";
    }


}


$product1 = new Product('Zabawka','Zabawka dla dzieci powyżej 7 lat', 20.00, 1);
var_dump($product1);
$product2 = new Product('Młotek','Narzędzie do wbijania gwoździ', 19.90, 2);
var_dump($product2);
$product3 = new Product('Śrubokręt','Narzędzie do wkręcania śrub', 11.20, 1);
var_dump($product3);
$product4 = new Product('Śrubokręt','Narzędzie do wkręcania śrub', 31.20, 1);
var_dump($product4);
$product5 = new Product('Wiertarka','Narzędzie do wiercenia', 311.70, 1);
var_dump($product5);


$cartWithProducts = new ShoppingCart();
$cartWithProducts->addProduct($product3);
$cartWithProducts->addProduct($product1);
$cartWithProducts->addProduct($product4);
$cartWithProducts->addProduct($product2);
$cartWithProducts->addProduct($product5);


$cartWithProducts->printRecipt();
$cartWithProducts->removeProduct(1);
$cartWithProducts->changeProductQuantity(2, 3);
$cartWithProducts->changeProductQuantity(0, 2);
$cartWithProducts->printRecipt();
