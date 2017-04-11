//INSTRUKCJE WARUNKOWE
if (warunek) {
    polecenia;
} else if (warunek2) {
    inne polecenia;
} else {
    jeszcze inne polecenia;
}

//--

var expression = "John";
switch (expression) {
    case "Ala":
        console.log("Jestem, wpadaj na kawę");
        break;
    case "John":
        console.log("Jestem, ale zaraz idę");
        break;
    default:
        console.log("Nie ma mnie w domu");
}

//--

//PĘTLE

//Pętla for
var result = 120;
for (var i = 0; i < 3; i++) {
    result = result + 1;
}


//Dopóki while spełniony jest warunek, wykonuj pętlę.
var i = 0;
while (i != 5) {
    console.log("Pętle są fajne");
    i = Math.floor(Math.random() * 10);
}


// Pętla do ... while działa tak samo jak pętla while, z tym że kod wykona się zawsze przynajmniej jeden raz, ponieważ kod z bloku do     wykonuje się najpierw a dopiero sprawdzany jest warunek while.

var i = 0;
do {
    console.log("Pętle są fajne");
    i = Math.floor(Math.random() * 10);
}
while (i != 5);

//Break - Wszystkie pętle możemy zakończyć przed warunkiem stopu za pomocą polecenia break.

for (var i = 0; i < 3; i++) {
    var result = Math.floor(Math.random() * 10);
    if (result === 5) {
        break;
    }
}



//-----

//OPERATORY ARYTMETYCZNE
var liczba1 = 2;
var liczba2 = 4;
liczba1 + liczba2; // 6
liczba1 - liczba2; // -2
liczba1 / liczba2; // 0.5
liczba1 * liczba2; // 8
liczba1 % liczba2; // 2
liczba1++; // 3 - Inkrementacja: liczba1 = liczba1 + 1;
liczba2--; // 3 - Dekrementacja: liczba2 = liczba2 - 1;


var text1 = "2";
var liczba2 = 4;
//Oprócz dodawania JavaScript podczas wykonywania działań zamienia stringa na liczbę. Ale tylko wtedy, jeżeli może!

text1 + liczba2; // "24"
text1 - liczba2; // -2
text1 / liczba2; // 0.5
text1 * liczba2; // 8
text1 % liczba2; // 2

//---


//OPERATORY PORÓWNANIA
var liczba1 = 1;
var liczba2 = 77;

liczba1 == liczba2; // false
liczba1 != liczba2; // true
liczba1 === liczba2; // false
liczba1 !== liczba2; // true
liczba1 > liczba2; // false
liczba1 < liczba2; // true
liczba1 >= liczba2; // false
liczba1 <= liczba2; // true

var text = "2";
var liczba1 = 2;

text == liczba1 // true;
text === liczba1 // false;


//--

//OPERATORY PRZYPISANIA:
var liczba3 = 1;
var text = "Ala ma kota";

liczba3 += 2; // 3
liczba3 -= 100; // -99
liczba3 *= 25; // 25
liczba3 /= 12; // 0.083333
liczba3 %= 4; // 1

text += "a"; // Ala ma kotaa   -  W przypadku przypisywania do stringów tylko konkatenacja ma sens. Reszta operatorów zwróci NaN.


//--

//OPERATORY LOGICZNE
var liczba3 = 23;
//&& AND (logiczne i) - Jeżeli pierwszy warunek nie jest spełniony, dalsza część nie jest sprawdzana i zwracana jest wartość false ponieważ obydwa warunki muszą być spełnione.
(liczba3 != 23) && (liczba3 > 10)

// || OR (logiczne lub) Wystarczy, że jeden z tych warunków będzie spełniony – zwracana jest wartość true.
(liczba3 != 23) || (liczba3 >10)

// ! NOT (logiczne nie) Jeżeli warunek jest prawdą, zwróci false i na odwrót.
var liczba3 = 23;
!(liczba3 > 22)

// ^ XOR - Operator sprawdza, czy jeden z dwóch warunków jest spełniony, przy czym nie mogą być spełnione oba. Jeśli jest spełniony jeden warunek, wtedy zwraca true, jeśli żaden lub dwa – false.
(liczba3 > 22) ^ (liczba3 != 23)


