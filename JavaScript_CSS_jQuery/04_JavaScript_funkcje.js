//Deklaracja funkcji i wywołanie
function getName() {
    console.log("Ala");
    //Deklaracja funkcji zostanie wykonana dopiero wtedy, kiedy ją wywołamy.
}
getName(); //Wywołanie funkcji

//------

//Wyrażenie funkcyjne - Funkcję przypisujemy do zmiennej.
var foo = function getName() {
      console.log("Ala");
    }
foo();

//Anonimowe wyrażenie funkcyjne - Funkcję przypisujemy do zmiennej i usuwamy jej nazwę.
var bar = function() {
    console.log("Ala");
}
bar();


//---------------------
//PRZYKŁADY:

//zadanie A1 - Stwórz funkcję, która zwraca (przez return) sumę trzech liczb. Liczby powinny być przekazane do funkcji jako argumenty.

//definiuejmy funkcje z 3 argumentami
function addNumbers(a, b, c) {
    //korzystamy z przekazanych argumentow
    //ZWRACAMY sume 3 argumentów
    return a + b + c;
}

console.log('Zadanie A1');
console.log(addNumbers(4, 5, 8));
console.log('------------------------');

//zadanie A2 - Napisz funkcję liczącą pole i obwód okręgu. Funkcja przyjmuje promień tej figury geometrycznej jako argument. Jeśli przekazany argument jest nieodpowiedniego typu, to funkcja ma zwrócić false.

//definiujemy funkcję
function circleCalculations(r) {
    //sprawdzamy czy promien jest odpowiedniego typu
    if (typeof r == 'number') {
        //obliczamy pole
        var area = Math.PI * Math.pow(r, 2);
        //obliczamy obwod
        var permiter = 2 * r * Math.PI;
        console.log('Dla promienia ' + r);
        console.log('Pole to: ' + area);
        console.log('Obwód to: ' + permiter);
    } else {
        //ZWRACAMY false
        return false;
    }
}

console.log('Zadanie A2');
console.log(circleCalculations(5));
console.log('------------------------');


//zadanie B1: Stwórz funkcję anonimową i przypisz ją do zmiennej. Zadaniem funkcji jest wypisanie dziesięć razy: "Gdy piszę kod zawszę i wszędzie używam funkcji oraz nie tworzę zmiennych globalnych".

var toPrint = function(){
    var count = 10;
    var line = "";
    for(var i = 1;i<=count;i++){
        line += " ";
        console.log("Działam ;) " + line);
    }
}


toPrint();
console.log('------------------------');
//Zadanie B2:
/*
 Napisz funkcję calculateTip(amount, raiting), która będzie przyjmować dwa argumenty:

 kwotę do zapłaty,
 opis słowny obsługi. Jeśli opis jest taki jak zdefiniowano poniżej, funkcja ma zwracać kwotę napiwku, jeśli opis jest nieznany – funkcja powinna zwracać napis "Opis nieczytelny".

 Opis może przyjmować następujące wartości: "Bardzo dobra obsluga" => 25% napiwku, "Dobra obsluga" => 20% napiwku, "Srednia obsluga" =>15% napiwku, "Zla obsluga" => 0% napiwku.

 Przykład:

 input -> 100, "Bardzo dobra obsluga"
 output -> 25

 */

function calculateTip(amount,raiting){
    //

    var result = 0;
    switch (raiting) {
        case 'Bardzo dobra obsluga':
            result = amount * 0.25;
            break;
        case 'Dobra obsluga':
            result = amount * 0.2;
            break;
        case 'Srednia obsluga':
            result = amount * 0.15;
            break;
        case 'Zla obsluga':
            result = amount * 0;
            break;
        default:
            result = "Opis nieczytelny";

    }
    console.log (result);
    return result;

}

var amount = 100;
var raiting = "Bardzo dobra obsluga";
calculateTip(amount, raiting); // 25golda

raiting = "Dobra obsluga";
calculateTip(amount, raiting); // 20golda

raiting = "Srednia obsluga";
calculateTip(amount, raiting); // 15 golda

raiting = "Zla obsluga";
calculateTip(amount, raiting); // 0 golda

raiting = "Poprosze o rabat;P";
//Można to też wywołać w ten sposób - wtedy nie dajem console.log w funkcji calculateTip
var wynik = calculateTip(amount, raiting); // "Opis nieczytelny."
console.log (wynik);

console.log('------------------------');
