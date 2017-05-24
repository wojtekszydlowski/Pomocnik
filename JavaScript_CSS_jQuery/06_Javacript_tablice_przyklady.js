/**
 Zadanie A1:
 Zajrzyj do pliku zadanieA1.js – jest tam napisany szkielet funkcji przyjmującej tablicę. Dopisz ciało funkcji w taki sposób, żeby zwracać true (wartość booleanowską), kiedy tablica ma liczby rosnące (każda następna jest większa od poprzedniej), a false – jeżeli nie. Pamiętaj, żeby użyć słowa kluczowego return do zwracania danych z funkcji.
 */


function isNumbersGrowing(array) {
    // Do tablicy możesz się odnieść przez zmienną array.
    // Pamiętaj o zwróceniu poprawnych danych (return true albo return false).
    var maxValue = array[0]; //można też maxValue = Number.NEGATIVE_INFITY (jako minus nieskończoność)
    for (var i=1; i<array.length;i++) {
        if (array[i] > maxValue) {
            maxValue = array[i];
        } else {
            return false;
        }
    }
    return true;
}

console.log("tablica [1,2,3,4,5,6,7]  jest rosnąca (powinno zwrócić true) " + isNumbersGrowing([1,2,3,4,5,6,7]));
console.log("tablica [1,2,10,4,5,6,7] nie jest rosnąca (powinno zwrócić false) " + isNumbersGrowing([1,2,10,4,5,6,7]));
console.log("tablica [-5,-4,0,4,6,21]  jest rosnąca (powinno zwrócić true) " + isNumbersGrowing([-5,-4,0,4,6,21]));
console.log("tablica [-1,2,-1,4,5,6,7] nie jest rosnąca (powinno zwrócić false) " + isNumbersGrowing([-1,2,-1,4,5,6,7]));
console.log("tablica [8]  jest rosnąca (powinno zwrócić true) " + isNumbersGrowing([8]));



//-------------------

/**
 Zadanie A2:
 Napisz dwie funkcje add(array) i multiply(array). Obie mają przyjmować tylko jeden argument – tablicę. Następnie funkcja add ma zsumować wszystkie liczby znajdujące się w tej tablicy (przy pomocy pętli for), a funkcja multiply ma pomnożyć wszystkie liczby znajdujące się w tablicy (przy pomocy pętli for).
 */

function add (givenArray){
    var sum =0 ;
    for (i=0;i<givenArray.length;i++){
        sum += givenArray [i];
    }
    console.log (sum);
    return sum;
}

function multiply (givenArray){
    var multiplyValue =1 ;
    for (i=0;i<givenArray.length;i++){
        multiplyValue *= givenArray [i];
    }
    console.log (multiplyValue);
    return multiplyValue;

}

array = [1,2,3,4,5,6,7,8,9,10];
add (array);
multiply (array);

//-------------------

/**
 Zadanie A3:
 Napisz funkcję distFromAvarage, która ma przyjmować jako argument tablicę z liczbami. Zwracana przez funkcję tablica ma przedstawiać w kazdej komórce różnicę między liczbą z danej komórki a średnią wartością tablicy. Dla uproszczenia możesz użyć funkcji z poprzedniego zadania. Np.

 distFromAvarage([1,2,3,4,5,6,7]) => [3,2,1,0,1,2,3] (średnia z tablicy wejściowej to 4)
 distFromAvarage([1,1,1,1]) => [0,0,0,0] (średnia z tablicy wejściowej to 1)
 distFromAvarage([2,8,3,7]) => [3,3,2,2] (średnia z tablicy wejściowej to 5)

 */

function add (givenArray){
    var sum =0 ;
    for (i=0;i<givenArray.length;i++){
        sum += givenArray [i];
    }
    //console.log (sum);
    return sum;
}

function distFromAvarage (givenArray){
    var resultArray = [];
    var sum = add(givenArray);
    var avg = sum / givenArray.length;

    //console.log(sum,avg);

    for (i = 0; i<givenArray.length; i++){
        //Pierwszy sposób
        //resultArray[i] = Math.abs(avg - givenArray[i]); //abs - wartość bezwzględna
        //Drugi sposób - push dodaje na koniec tablicy, nie musimy wiedzieć jak duża jest tablica
        resultArray.push(Math.abs(avg - givenArray[i]));
    }


    console.log (resultArray);
    return resultArray;
}


distFromAvarage([1,2,3,4,5,6,7]); // => [3,2,1,0,1,2,3] (średnia z tablicy wejściowej to 4)
distFromAvarage([1,1,1,1]); // => [0,0,0,0] (średnia z tablicy wejściowej to 1)
distFromAvarage([2,8,3,7]); //=> [3,3,2,2] (średnia z tablicy wejściowej to 5)


//-------------------

/**
 Zadanie B1:
 Stwórz tablicę z listą swoich ulubionych owoców. Następnie:
 Wypisz pierwszy owoc w konsoli.
 Wypisz ostatni owoc w konsoli (skorzystaj z atrybutu length).
 W pętli wypisz wszystkie owoce (skorzystaj z atrybutu length).

 */


var fruit = ["Jablko", "Banan", "Czeresnie", "Winogrona"];
var tableSize = fruit.length - 1;

console.log ("Pierwszy owoc w tablicy to: " + fruit[0]);
console.log ("Ostatni owoc w tablicy to: " + fruit[tableSize]);

for (var i=0; i<=tableSize;i++) {
    console.log ("Owoc [" + i + "] to " + fruit[i]);
}

//-------------------


/**
 Zadanie B2:
 Napisz funkcję printTable(array), która przyjmuje tylko jeden parametr – tablicę. Następnie przy pomocy pętli for przeiteruj (przejdź) po każdym elemencie i wypisz każdy z nich w konsoli.
 */

function printTable(array){
    for (var i=0;i<array.length;i++) {
        console.log (array[i]);
    }
}

var array = [3,2,4,6,2,1,2,3,7,8];
printTable(array);


//-------------------

/**
 Zadanie B3:
 Napisz funkcję factors, która ma przyjmować tylko jeden argument – liczbę, która musi być większa od 0. Funkcja ta ma zwracać tablicę zawierającą wszystkie dzielniki podanej liczby (w kolejności malejącej). Jeżeli liczba jest mniejsza lub równa 0, to funkcja ma zwracać pustą tablicę.

 factors(2) => [2, 1]
 factors(54) => [54, 27, 18, 9, 6, 3, 2, 1]
 factors(-4) => []

 */

function factors (givenVar) {
    var resultArray = [];
    if (givenVar > 0) {
        for (var i = givenVar; i>0; i--){
            if ((givenVar % i) == 0) {
                resultArray.push(i);
            }
        }
    }
    console.log (resultArray);
    return resultArray;
}

factors (54);
factors (2);
factors (-4);

//-------------------

/**
 Zadanie B4:

 Napisz funkcję getMissingElement, która ma przyjmować tylko jeden argument – tablicę zawierającą rosnące liczby całkowite. Funkcja ta ma zwracać brakującą liczbę (czyli miejsca, w którym tablica skacze o dwa zamiast o jeden). Jeżeli w tablicy nie ma brakujących liczb, to funkcja ma zwracać null.

 getMissingElement([1,2,3,4,5,6,7]) => null
 getMissingElement([6,7,8,10,11,12,13,14,15]) => 9
 getMissingElement([-4,-3,-2,0,1,2,3,4]]) => -1

 */

function getMissingElement(array){
    var getElement = array[0];

    for (var i=1; i<array.length;i++){
        var checkElement = getElement + 1;

        //console.log (checkElement, array[i]);
        if (checkElement !== array[i]) {
            //return i;
            return checkElement;
        } else {
            getElement = array[i];
        }

    }

    return null;
}
console.log (getMissingElement([1,2,3,4,5,6,7]));
console.log (getMissingElement([6,7,8,10,11,12,13,14,15]));
console.log (getMissingElement([-4,-3,-2,0,1,2,3,4]));