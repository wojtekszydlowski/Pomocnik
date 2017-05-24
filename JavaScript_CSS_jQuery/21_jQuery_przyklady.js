//----------------
//--- EVENTY -----
//----------------



/**
 Na stronie znajdują się trzy guziki. Napisz jeden event dla wszystkich guzików, który ma być podpięty do elementu rodzica o id bubblingButtons, który spowoduje, że po kliknięciu licznik znajdujący się w atrybucie data-counter zwiększy wartość o jeden. Pamiętaj, żeby wszystko pisać w evencie DOMContentLoaded.

 KOD HTML:
 <div id="bubblingButtons">
 <button data-counter="0">KLIK 1</button>
 <button data-counter="0">KLIK 2</button>
 <button data-counter="0">KLIK 3</button>
 </div>
 */

$(document).ready(function() {

    $('#bubblingButtons').find('button').on("click", function (e) {
        var currentClicksNumber = Number($(this).attr("data-counter"));
        var newNumber = currentClicksNumber + 1;
        $(this).attr("data-counter", newNumber);

    });

});


//-------

/**
 Na stronie znajduje się guzik. Podepnij do niego event, który na kliknięcie spowoduje, że w konsoli wyświetli się napis "Hura! Działa!". Pamiętaj, żeby wszystko pisać w evencie DOMContentLoaded.

 KOD HTML:
 <button id="mainBtn">Click me!</button>
 */


$(document).ready(function() {

    $("button").on("click", function () {
        console.log("Hura");
    });

});


//-------

/**
 Na stronie znajdują się trzy guziki i trzy liczniki (elementy span o klasie counter). Do każdego guzika dopisz event, który spowoduje, że przypisany do niego licznik zwiększy swoją wartość o 1 po kliknięciu w guzik. Pamiętaj, żeby wszystko pisać w evencie DOMContentLoaded.

 KOD HTML:
 <button id="button1">Guzik 1</button>
 <p>
 Wartość licznika 1: <span class="counter">0</span>
 </p>

 <button id="button2">Guzik 2</button>
 <p>
 Wartość licznika 2: <span class="counter">0</span>
 </p>

 <button id="button3">Guzik 3</button>
 <p>
 Wartość licznika 3: <span class="counter">0</span>
 </p>
 */

$(document).ready(function() {


    //Pierwszy sposób - dla każdego z przycisków tak trzeba by było napisać
    //  var button1 = $("#button1");
    //  button1.on("click", function () {
    //  //button1.find("span:eq(0)").text("a");
    //      $("span:eq(0)").text("a");
    // });


    //Drugi sposób - bardziej uniwersalny
    var buttons = $("button");
    buttons.each(function (index, element) {
        $(this).on("click", function() {
            //$('span:eq(index)').text("a"); - to nie zadziała, musi być  $("span").eq(index)...
            var currentNumber = Number($("span").eq(index).text());
            var newValue  = currentNumber + 1;
            $("span").eq(index).text(newValue); //wyszukuje znacznika span o numerze index (0 to pierwsze wystąpienie span)

        });
    });

});

//-------------


/**
 Na stronie znajdują się trzy guziki i jeden licznik. Napisz jeden wspólny event dla wszystkich guzików, który spowoduje, że po kliknięciu w guzik licznik zwiększy wartość o jeden. Pamiętaj, żeby wszystko pisać w evencie DOMContentLoaded.

 KOD HTML:
 <button id="button1">Guzik 1</button>
 <button id="button2">Guzik 2</button>
 <button id="button3">Guzik 3</button>
 <p>
 Wartość licznika: <span class="counter">0</span>
 </p>
 */

$(document).ready(function() {

    var buttons = $("button");
    buttons.each (function () {
        $(this).on("click", function () {
            var counter = Number ($("span").text());
            counter ++;
            $("span").text(counter);
        });
    });


});

//-----------

/**
 Na stronie znajdują się trzy elementy div, dla których napisz wspólny event zmieniający kolor tła tylko w klikniętym divie. Użyj do tego słowa kluczowego this. Pamiętaj, żeby wszystko pisać w evencie DOMContentLoaded.

 Hint: Żeby uzyskać losowy kolor użyj poniższego kodu:

 var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16);

 KOD HTML:
 <div class="box" id="box1">Div 1</div>
 <div class="box" id="box2">Div 2</div>
 <div class="box" id="box3">Div 3</div>
 */

$(document).ready(function() {

//Pierwszy - dłuższy sposób
// var divs = $("div");
// divs.each(function (index, element) {
//     $(this).on("click", function () {
//         var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16);
//         //$("div").eq(index).css("backgroundColor", randomColor);
//         $(this).css("backgroundColor", randomColor);
//         //console.log($(this));
//     });
// });

    $("div").on("click", function () {
        var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16);
        $(this).css("backgroundColor", randomColor);
    });

});


//-----------------


/**
 W pliku znajdują się trzy listy (każda osadzona w elemencie div). Po najechaniu myszką na element div zmienić się mają kolory tła elementów jego listy. Odpowiednio:

 Pierwszy element w liście ma mieć kolor czerwony.
 Ostatni element w liście ma mieć kolor niebieski.
 Wszystkie inne elementy mają mieć kolor zielony.
 Po najechaniu myszką na element div dodaj mu klasę hovered, ale tylko jemu.

 Rozwiązanie musi spełniać następujące założenia:

 Na wszystkie divy musi być założony ten sam event.
 Elementy listy mają być wyszukane w zależności od this.

 KOD HTML:
 <div class="listContainer">
 <ul class="list">
 <li>Item 1</li>
 <li>Item 2</li>
 <li>Item 3</li>
 <li>Item 4</li>
 <li>Item 5</li>
 </ul>
 </div>

 <div class="listContainer">
 <ul class="list">
 <li>Item 1</li>
 <li>Item 2</li>
 <li>Item 3</li>
 <li>Item 4</li>
 <li>Item 5</li>
 </ul>
 </div>

 <div class="listContainer">
 <ul class="list">
 <li>Item 1</li>
 <li>Item 2</li>
 <li>Item 3</li>
 <li>Item 4</li>
 <li>Item 5</li>
 </ul>
 </div>

 */


$(document).ready(function() {

    $(".listContainer").on("mouseover", function () {
        $(this).find('li').css("color","green");
        $(this).find('li').eq(0).css("color","red");
        $(this).find('li').eq(-1).css("color","blue");
        $(this).addClass("hovered");

    });

});


//-----------------


/**
 W pliku znajduje się kilka przycisków (są to odpowiednio postylowane linki). Po kliknięciu w którykolwiek z nich – element, który znajduje się bezpośrednio po nim, powinien zniknąć (jeżeli był widoczny) lub się pojawić (jeżeli był niewidoczny). Rozwiązanie musi spełniać następujące założenia:

 Na wszystkie przyciski musi być założony ten sam event.
 Następny element ma być wyszukiwany zależnie od położenia this.
 Kod musi działać poprawnie i nie generować błędów (pamiętaj o sprawdzeniu, czy następny element nie równa się null).

 KOD HTML:
 <a id="button1" class="button">Guzik 1</a>
 <div class="box" id="box1">
 </div>

 <a id="button2" class="button">Guzik 2</a>
 <div class="box" id="box2">
 </div>

 <a id="button3" class="button">Guzik 3</a>
 <div class="box" id="box3">
 </div>


 CSS:
 .hidden {
    visibility: hidden;
}

 */



$(document).ready(function() {

    //Przykład z dodaniem/usunięciem klasy
    $('a').on("click", function() {
        $(this).next("div").toggleClass("hidden");
    });

});



//------------


/**
 W pliku znajduje się kilka przycisków (są to odpowiednio postylowane linki). Po kliknięciu w którykolwiek z nich jego rodzic ma zmienić kolor tła (na losowy). Rozwiązanie musi spełniać następujące założenia:

 Na wszystkie przyciski musi być założony ten sam event.
 Rodzic ma być wyszukiwany zależnie od położenia this.
 Kolor tła musi być losowy.

 Hint: Żeby uzyskać losowy kolor, użyj poniższego kodu:

 var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16);

 KOD HTML:
 <div class="box" id="box1">
 <a id="button1" class="button">Guzik 1</a>
 </div>

 <div class="box" id="box2">
 <a id="button2" class="button">Guzik 2</a>
 </div>

 <div class="box" id="box3">
 <a id="button3" class="button">Guzik 3</a>
 </div>
 */



$(document).ready(function() {

    $('.button').on("click", function() {
        var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16);
        $(this).parent().css("backgroundColor",randomColor);
    });

});


//-------------


/**
 Na stronie znajduje się tabela z informacjami na temat zamówień (z dwoma już wprowadzonymi zamówieniami). Poniżej znajduje się formularz do wypełnienia nowego zamówienia. Napisz event, który pobierze informacje z inputów (el.value) i wprowadzi nowy wpis do tablicy.
 */


$(document).ready(function() {

    $('.button').on("click", function () {
        var orderId = $('#orderId').val();
        var item = $('#item').val();
        var quantity = $('#quantity').val();

        var newTableElement = "<tr><td>" + orderId + "</td><td>" + item + "</td><td>" + quantity + "</td></tr>";
        var currentTable = $("#orders");
        currentTable.append(newTableElement);

        console.log(orderId);
    });

});


//------------


/**
 Na stronie przypisanej do zadania znajduje się lista i guzik. Dopisz odpowiednie eventy do nich w taki sposób, żeby po kliknięciu w guzik dodał się nowy element do listy. Element powinien mieć w sobie informacje na temat tego, ile elementów jest w liście w chwili jego dodania.

 KOD HTML:
 <ul class="menu">
 <!-- Przykładowy element: <li>Element 1 - w chwili dodania było 0 elementów</li> -->
 </ul>

 <a class="button">Add element to list!</a>
 */


$(document).ready(function() {

    $('.button').on("click", function () {

        var ourUl = $("ul");
        var currentNumber = $("ul li").length;
        var newLi = "<li>Element " + Number (currentNumber + 1) + " - w chwili dodania było " + currentNumber + " elementów</li>";
        ourUl.append(newLi);
    });

});


//--------------

/**
 Na stronie znajduje się guzik. Dopisz do niego event w taki sposób, żeby po kliknięciu w niego guzik został usunięty ze strony.

 KOD HTML:
 <a class="button" id="remove">Dodaj przedmiot</a>
 */

$(document).ready(function() {
    $('.button').on("click", function () {
        $('.button').remove();
    });

});

//----------

/**
 Na stronie znajduje się lista z wpisami i guzik. Napisz taki event, żeby po kliknięciu w guzik z listy zostały usunięte wszystkie jej dzieci.

 KOD HTML:
 <ul class="list">
 <li>Element 1</li>
 <li>Element 2</li>
 <li>Element 3</li>
 <li>Element 4</li>
 </ul>

 <a class="button" id="remove">Usuń wszystko</a>
 */


$(document).ready(function() {
    $('.button').on("click", function () {
        $('ul').empty();
    });

});

//-----------------

/**
 Na stronie znajduje się tabela podobna do tej z zadania 1. Tym razem przy każdym zamówieniu znajduje się dodatkowo guzik, który służy do usuwania tego zamówienia. Dopisz do niego odpowiedni event, który spowoduje, że dane zamówienie zniknie z tablicy. Spróbuj zrobić to w taki sposób, żeby wszystkie guziki korzystały z tego samego eventu (użyj this).

 KOD HTML (fragment):
 <tr>
 <td >
 1
 </td>
 <td>
 Komputer
 </td>
 <td>
 2
 </td>
 <td>
 <a class="deleteBtn">Usuń przedmiot</a>
 </td>
 </tr>
 */


$(document).ready(function() {
    $('.deleteBtn').on("click", function () {
        var toDelete = $(this).parent().parent().remove();
    });

});

//---------


/**
 Na stronie znajdują się dwie listy. Obok każdego wpisu (w obu listach) znajdują się przyciski. Napisz taki kod JavaScript, żeby po przyciśnięciu guzika element listy był przenoszony do drugiej listy. Pamiętaj, że element może być przenoszony wiele razy (np. z listy 1 do listy 2, a potem z powrotem do listy 1).

 KOD HTML:
 <div class="listContainer two">
 <ul id="list1">
 <li>Item 1 z listy 1 <a class="moveBtn">Przenieś</a></li>
 <li>Item 2 z listy 1 <a class="moveBtn">Przenieś</a></li>
 <li>Item 3 z listy 1 <a class="moveBtn">Przenieś</a></li>
 <li>Item 4 z listy 1 <a class="moveBtn">Przenieś</a></li>
 <li>Item 5 z listy 1 <a class="moveBtn">Przenieś</a></li>
 </ul>
 </div>


 <div class="listContainer two">
 <ul id="list2">
 <li>Item 1 z listy 2 <a class="moveBtn">Przenieś</a></li>
 <li>Item 2 z listy 2 <a class="moveBtn">Przenieś</a></li>
 <li>Item 3 z listy 2 <a class="moveBtn">Przenieś</a></li>
 <li>Item 4 z listy 2 <a class="moveBtn">Przenieś</a></li>
 <li>Item 5 z listy 2 <a class="moveBtn">Przenieś</a></li>
 </ul>
 </div>
 */


$(document).ready(function() {
    $('.moveBtn').on("click", function () {
        var currentUl = $(this).parent().parent().attr('id');
        var elementToMove = $(this).parent();
        //console.log(currentUl);

        if (currentUl == "list1") {
            elementToMove.detach();  //jakby było remove() to by usunął go (można by było tylko raz tak zrobić), a tak go tylko odpina i później można ponownie dodać go do tej samej listy
            var whereToMove = $('#list2');
            whereToMove.append(elementToMove);
            console.log(elementToMove);
        } else {
            elementToMove.detach();
            var whereToMove = $('#list1');
            whereToMove.append(elementToMove);
        }

        console.log(elementToMove);
        //var toMove = $(this).parent().parent().remove();
    });

});

//------------


//----------------
//-- FORMULARZE --
//----------------


/**
 Walidacja karty kredytowej. Zadanie polega na walidacji kart kredytowych wpisywanych w formularz na stronie. Walidacja ma następować w czasie rzeczywistym (czyli po wprowadzeniu każdej cyfry). Nazwa karty ma być wpisana, jak tylko jest możliwe jej ustalenie. Poprawność karty ma być pokazana po wpisaniu odpowiedniej liczby cyfr.

 Zasady rozpoznawania kart:

 Karty Visa zaczynają się od cyfry 4.
 Karty Mastercard zaczynają się od cyfry 5.
 Karty American Express zaczynają się od cyfry 3. Następną cyfrą musi być 4 lub 7.

 Zasady walidacji kart:

 Karty Visa mają od 13 do 16 cyfr.
 Karty Mastercard mają równo 16 cyfr.
 Karty American Express mają równo 15 cyfr.

 Zasady walidacji kart są uproszczone (nie powinniście ich stosować w rzeczywistych projektach). Jeżeli chcesz poznać prawdziwe zasady walidacji kart kredytowych, to są one opisane tutaj: https://en.wikipedia.org/wiki/Bank_card_number https://en.wikipedia.org/wiki/Luhn_algorithm


 */

function defineCompanyCard (number) {
    var companyCard = "";
    var firstDigit = Number(number[0]);
    var secondDigit = Number(number[1]);
    if (firstDigit == 4) {companyCard = "VS";}
    if (firstDigit == 5) {companyCard = "MC";}
    if (firstDigit == 3 && (secondDigit==4 || secondDigit==7)) {companyCard = "AE";}
    return companyCard;
}

function checkValidNumber (number, companyCard) {
    //0 - błędny numer karty, 1-na razie ok, ale jeszcze niepełny numer, 2-numer karty prawidłowy
    validNumber = 0;
    if (companyCard.length==0 && number.length>2) {return validNumber;}
    if (companyCard == "VS" && number.length<13) {var validNumber=1; return validNumber;}
    if (companyCard == "VS" && number.length>12 && number.length<17) {var validNumber=2; return validNumber;}
    if (companyCard == "VS" && number.length>16) {var validNumber=0; return validNumber;}
    if (companyCard == "MC" && number.length<16) {var validNumber=1; return validNumber;}
    if (companyCard == "MC" && number.length==16) {var validNumber=2; return validNumber;}
    if (companyCard == "MC" && number.length>16) {var validNumber=0; return validNumber;}
    if (companyCard == "AE" && number.length<15) {var validNumber=1; return validNumber;}
    if (companyCard == "AE" && number.length==15) {var validNumber=2; return validNumber;}
    if (companyCard == "AE" && number.length>15) {var validNumber=0; return validNumber;}
    return validNumber;

}


$(document).ready(function() {

    var card = $('#card');
    card.on("keyup", function (e) {
        var cardNumber = ($(this).val());
        var companyCard = defineCompanyCard(cardNumber);
        $('#type').text(companyCard);
        var validNumber = checkValidNumber(cardNumber, companyCard);
        if (validNumber == 0) { $('#card').css("color", "red"); }
        if (validNumber == 1) { $('#card').css("color", "black"); }
        if (validNumber == 2) { $('#card').css("color", "green"); }

        //console.log(cardNumber[0]); //pokazuje pierwszy znak z wpisanego tekstu
    });

});


//-------------

/**
 Na stronie znajduje się formularz do zamówienia. Jest w nim sekcja odpowiedzialna za wystawienie faktury. Napisz kod JavaScript, który spowoduje, że sekcja ta jest widoczna tylko i wyłącznie wtedy, kiedy zaznaczony jest checkbox "Chcę otrzymać fakturę".

 FRAGMENT HTML:
 <div class="checkbox">
 <label><input type="checkbox" id="invoice"> Faktura VAT</label>
 </div>
 <div class='form-group' id="invoiceData">
 <label>NIP:</label>
 <input type="text" class='form-control' id='nip'>
 <label>Adres firmy:</label>
 <input type="text" class='form-control'  id='companyName'>
 <label>Nazwa firmy:</label>
 <input type="text" class='form-control'  id='companyAddress'>
 </div>
 */



$(document).ready(function() {

    var isChecked = ($('#invoice').prop("checked"));
    if (isChecked == false) {$('#invoiceData').addClass("hidden");}
    //$('#invoiceData').addClass("hidden");
    $('#invoice').on("click", function () {
        $('#invoiceData').toggleClass("hidden");
    });
});

//------

