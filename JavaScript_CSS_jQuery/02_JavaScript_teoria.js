// KOMENTARZE:

// Komentarz mieszczący się w jednej linii

/*
 Komentarz, który wykorzystuje więcej
 niż jedną linię
 */



//ZMIENNE:
var numberOfUsers = 4;


//URUCHAMIANIE KONSOLI JAVASCRIPT
// Na Windows: Crtl + Shift + I



//TYPY DANYCH:

//Prymitywne typy danych:
//Liczby(Number):
var liczba = 10;
var liczba2 = 2.2;

//Ciągi znaków (String)
var text = "Ala ma kota";
var text2 = "2.2";

//Wartości logiczne (Boolean)
var prawda = true;
var falsz = false;

//Specjalne
var foo = null;
var bar = undefined;

//Pozostałe typy danych:
//Obiekty
var kot = {
    imie: "Mruczek",
    wiek: 3
}
//Tablice
var tab1 = [1, 2, "Ala"];
var tab2 = [1, [2], 45 ];


//Sprawdzanie typu danych - typeof
typeof null; // object (bug)
typeof 2; //number
typeof "Ala ma kota"; //string


//Stringi – konwersja do liczb:
parseInt(string, system liczbowy 2–36)

//np.:
var textVar = "9";
var numberVar = parseInt(textVar, 10);

parseInt("24px", 10); // 24 (2*10^1 + 4*10^0)
parseInt("100", 2); // 4 (1*2^2 + 0*2^1 + 0*2^0)
parseInt("546", 2); // NaN – nie ma takich liczb w systemie dwójkowym
parseInt("Hello", 8); // NaN – to nie są cyfry


//Wartości logiczne:
var isChecked = false;
var isRendered = true;

// Fałszem jest również:
// 0 (zero)
// "" (pusty string)
// null
// undefined
// NaN


//Wartości specjalne:
var foo = null;
var bar = undefined;

//null reprezentuje pustą wartość. Uwaga! null nie oznacza 0(zero).
//undefined reprezentuje wartość niezdefiniowaną, czyli jeżeli stworzymy zmienną i nic do niej nie przypiszemy, wywołanie jej zwróci undefined np.
var maxValue;
maxValue; //Konsola wypisze undefined