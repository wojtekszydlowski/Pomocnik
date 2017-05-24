//setTimeout - Wywołuje podaną funkcje po podanym czasie (czas podajemy w milisekundach).
var timeout = setTimeout(function () {
    console.log('I will be invoke in 5s');
}, 5000); // 5s


//clearTimeout - clearTimeout czyści timeout nastawiony przez funkcję setTimeout(). Do tej funkcji musicie podać ID timera, który chcecie usunąć.
var timeout = setTimeout(function () {
    console.log('I will be invoke in 5s');
}, 5000); // 5s
clearTimeout(timeout);


//setInterval - Uruchamia podaną funkcję co podany przedział czasu (czas podajemy w milisekundach).
var interval = setInterval(function () {
    console.log('I will be invoke every 5s');
}, 5000); // 5s


//clearInterval - clearInterval czyści interval nastawiony przy pomocy setInterval().
var interval = setInterval(function () {
    console.log('I will be invoke every 5s');
}, 5000); // 5s
clearInterval(interval);



//PRZYKŁADY:

/**
 Zadanie 1:  Napisz funkcję boilEgg, która jako argument przyjmie czas w sekundach, a jej wywołanie spowoduje, że po zadanym czasie na konsoli wyświetli się komunikat "jajko ugotowane". Dodatkowo co 5 sekund, podczas gotowania w konsoli wyświetl napis "jajko się gotuje". Przetestuj swoją funkcję dla 30 sekund (czas gotowania).
 */

//Mój przykład

// var boilEgg  = setTimeout(function () {
//     console.log('Jako ugotowane');
//     clearInterval(boilingEgg);
// }, 30000); // 30s
//
// var boilingEgg = setInterval(function() {
//         console.log('Jajko się gotuje');
//
//     }, 5000);



// -----------------------

//To samo robione na zajęciach

function boilEgg (givenTime) {
    var time = givenTime * 1000;
    var boliledEgg = setTimeout(function(){
        console.log("Jajko ugotowane");
        clearInterval(boilingEgg);

    },time);

    var boilingEgg = setInterval(function(){
        console.log("Jajko się gotuje");
    },5000);
}

boilEgg(30);