var mixTypes = ["Ala",
    23,
    true,
    { name: "Ala"},
    function() { return 2; },
    null
];

//Indeksy (klucze) tablic rozpoczynają się od 0.

mixTypes[0]; // wypisze "Ala"
mixTypes[1]; // wypisze 23
mixTypes[2]; // wypisze true
mixTypes[3].name; // wypisze "Ala"
mixTypes[4](); // wypisze 2
mixTypes[5]; // wypisze null

//Aby pobrać wielkość tablicy, korzystamy z atrybutu length:
mixTypes.length; // 6

//TABLICE - METODY:
/*
arr – to zmienna, która jest tablicą

Metody mutacyjne - Modyfikujące oryginalną tablicę:
arr.pop – usuń i zwróć ostatni element tablicy
arr.push – dodaj element do końca tablicy
arr.reverse – odwróć całą tablicę
arr.shift – usuń i zwróć pierwszy element tablicy
arr.sort – posortuj elementy na podstawie przekazanej funkcji
arr.splice – usuń (ew. zamień) i zwróć kawałek tablicy
arr.unshift – dodaj element na początek tablicy

Metody dostępowe
arr.concat – połącz dwie tablice
arr.join – połącz wszystkie elementy tablicy w ciąg znaków,użyj przekazanego argumentu
arr.slice – zwróć kawałek tablicy
arr.indexOf – pozycja szukanego elementu
arr.lastIndexOf – ostatnia pozycja szukanego elementu

Metody iteracyjne - są to funkcje wyższego rzędu, czyli przyjmujące inną funkcję jako argument.
arr.forEach – wywołaj funkcję dla każdego z elementów,
arr.every – sprawdź, czy wszystkie elementy spełniają dany warunek
arr.some – sprawdź, czy jakikolwiek element spełnia dany warunek
arr.filter – wywołaj funkcję dla każdego z elementów, zwróć nową tablicę zawierającą tylko te elementy które go spełniły
arr.map – wywołaj funkcję dla każdego z elementów, zwróć nową  tablicę ze zmodyfikowanymi elementami

*/

//METODY MUTACYJNE
//pop()
var foo = [1, 2, 3, 4];
var lastElem = foo.pop();
console.log(foo); // [ 1, 2, 3]

//push()
var foo = [1, 2, 3];
foo.push(12);
console.log(foo); // [ 1, 2, 3, 12]

//reverse()
var foo = [1, 2, 3];
foo.reverse();
console.log(foo); // [ 3, 2, 1]

//shift()
var foo = [1, 2, 3, 12];
var firstElem = foo.shift();
console.log(foo); // [ 2, 3, 12]

//unshift()
var foo = [2, 3, 12];
foo.unshift(5);
console.log(foo); // [ 5, 2, 3, 12]

//splice( [index początkowy], liczbaElementów, elementy do wstawienia )
var foo = [1, 2, 3]; //usuń pierwszy element
foo.splice(0, 1); //0 to indeks, 1 to ilość elem.
console.log(foo); // [2, 3]

var foo = [2, 3]; //usuń ostatni element
foo.splice(-1);
console.log(foo); // [2]


var foo = [1, 2, 3, 4]; //Zacznij od indeksu 2, usuń jeden element i wstaw liczbę 24 oraz string "kot".
foo.splice(2,1, 24, "kot");
console.log(foo); // [1, 2, 24, "kot", 4]

//concat()
var foo = [1, 2, 3];
var bar = [5, 6];
var baz = foo.concat(bar);
console.log(baz); // [ 1, 2, 3, 5, 6]

//join()
var foo = ["wsiąść", "do", "pociągu"];
var text = foo.join();
console.log(text); // wsiąść,do,pociągu

var foo = ["wsiąść", "do", "pociągu"];
var text = foo.join("+");
console.log(text); // wsiąść+do+pociągu

//slice()
var foo = [1, 2, 3];
var restFoo = foo.slice(0, 2); //Zwróć dwa elementy, zacznij od indeksu 0.
console.log(restFoo); // [ 1, 2]

//indexOf()
var foo = [1, 2, 3];
var index = foo.indexOf(2);
console.log(index); // 1

//lastIndexOf()
var foo = [1, 2, 3, 1, 3, 3];
var index = foo.lastIndexOf(1);
console.log(index); // 3




//METODY ITERACYJNE
//forEach()
var foo = [1, 2, 3];
foo.forEach(function(element, index, array) {
    console.log("Element" + element);
});

//some()
var foo = [1, 2, 3];
foo.some(function(element, index, array) {
    return element % 2 !== 0;  //Sprawdź, czy jakikolwiek element jest nieparzysty, zwraca wartość boolean true lub false.
});

//every()
var foo = [1, 2, 3];
foo.every(function(element, index, array) {
    return element % 2 === 0; // Sprawdź, czy wszystkie elementy są parzyste, zwraca wartość boolean true lub false.
});

//filter()
var foo = [1, 2, 3, 4];
var bar = foo.filter(function(element, index,
                              array) {
    return element % 2 === 0;
});
console.log(bar); // [2, 4] - Znajdź tylko elementy parzyste.

//map()
var foo = [1, 2, 3, 4];
var bar = foo.map(function(element, index, array) {
    return element * 2;
});
console.log(bar); // [2, 4, 6, 8] - Pomnóż elementy przez dwa.