//Przykład tablicy wielowymiarowej:
var array2D = [
    [1, 2, 3, 4],
    ["Ala", "Adam", "Kasia"],
    [true, false],
];

//Tworzenie tablic wielowymiarowych
//- Jeżeli chcemy stworzyć tablicę wielowymiarową, musimy najpierw stworzyć tablicę główną, a następnie w każdej z jej komórek umieścić pustą tablicę.
var array2D = [];
array2D[0] = [];
array2D[1] = [];
array2D[2] = [];
array2D[3] = [];


var array2Dnew = [];
array2Dnew[0] = [1, 2, 3, 4, 5];
array2Dnew[1] = ["Ala", "Adam"];
array2Dnew[2] = ["Wojtek", "Kasia"];
array2Dnew[3] = [3, 4, 5, 6];

array2Dnew[0][4]; // Zwróci 5
array2Dnew[1][1]; // Zwróci "Adam”
array2Dnew[2][0]; // Zwróci "Wojtek"
array2Dnew[3][3]; // Zwróci 6
array2Dnew[3][4]; // Zwróci undefined


//------------

//ZADANIA:

/**
 Zadanie A1: Napisz funkcję checkArray przyjmującą jako argument tablicę dwuwymiarową z liczbami całkowitymi. Funkcja ma zwrócić nową tablicę, w której kolejnymi elementami będą wartości boolean true lub false, zależne od tego, czy każdy element tablicy drugiego wymiaru jest parzysty.

 var arr = [
 [11, 12],
 [42, 2],
 [-4, -120],
 [0, 0],
 [1, 34],
 ];

 output

 var arrayCheck = [
 false, // bo 11
 true,
 true,
 true,
 false, // bo 1
 ];
 ---------------
 -> input
 var arr = [];
 arr[0]=[3, 4, 56, 773, 1];
 arr[1]=[7, 12, 0, 98, 34, 381];
 arr[2]=[12, 66, 96, 54, 10];

 output ->
 arrayCheck[0] ma mieć wartość false
 arrayCheck[1] ma mieć wartość false
 arrayCheck[2] ma mieć wartość true
 */

function checkArray (givenArrey) {
    var resultArray = [];
    for (var i=0; i<givenArrey.length; i++) {
        var result = true;
        for (var j=0; j<givenArrey[i].length; j++) {
            if ((givenArrey[i][j]) % 2 !==0){
                result = false;
            }
            resultArray.push(result);
        }
    }
    return resultArray;
}

var arr = [
    [11, 12],
    [42, 2],
    [-4, -120],
    [0, 0],
    [1, 34],
];

console.log (checkArray(arr));

console.log ("---------------------");

/**
 Zadanie B1: Napisz funkcję print2DArray, która jako argument przyjmuje tablicę dwuwymiarową. Następnie funkcja ta ma wypisać w konsoli zawartość tej tablicy.
 */


function print2DArray (givenArrey) {
    for (var i=0; i<givenArrey.length; i++) {
        for (var j=0; j<givenArrey[i].length; j++) {
            console.log ("[" + i + "] [" + j + "]: " + givenArrey[i][j]);
        }
    }
}


function print2DArrayVer2 (givenArrey) {
    for (var i=0; i<givenArrey.length; i++) {
        var resultLine = "[";
        for (var j=0; j<givenArrey[i].length; j++) {
            if (j>0) {
                resultLine += ", " + givenArrey[i][j];
            } else {
                resultLine +=  givenArrey[i][j];
            }
            //console.log ("[" + i + "] [" + j + "]: " + givenArrey[i][j]);
        }
        console.log (resultLine + "]");
    }
}

print2DArrayVer2(arr);

console.log ("---------------------");
console.log ("Zadanie B3:");
/**
 Zadanie B3: Napisz funkcję create2DArray przyjmującą dwie liczby całkowite (rows i columns). Zadaniem funkcji jest zwrócenie tablicy dwuwymiarowej o podanej liczbie rzędów i kolumn. Każda komórka ma być wypełniona kolejną liczbą całkowitą. Nastepnie użyj rozwiązania z zadania B1 do wypisania tej tablicy w konsoli.
 Hint: Użyj petli zagnieżdżonych.
 */

function create2DArray (rows,cols) {
    var counter = 1;
    var rowArray = [];
    for (var r=0;r<rows;r++) {
        var colArray = [];
        for (var c=0; c<cols; c++){
            colArray.push(counter);
            counter ++;
        }
        rowArray.push(colArray);
    }
    return rowArray;
}

var arr = create2DArray(4,4);
print2DArray(arr);