/**
#Eventy w jQuery:
 Do sterowania eventami jQuery wystarczą trzy metody:
 - on(event, function) – pozwala na dodanie callbacka do eventu,
 - one(event, function) – pozwala na zapięcie nowego eventu, który zadziała tylko i wyłącznie raz, po czym zostanie automatycznie usunięty,
 - off(event, function) – usuwa wszystkie callbacki, które były podpięte pod dany event (nawet te anonimowe).

 Nazwy eventów, które przeglądarka nam udostępnia, są w większości identyczne jak te wykorzystujące metodę addEventListener.

 ----

#Propagacja eventów:
 Tak samo jak w czystym JavaScript eventy są propagowane. Jesteśmy w stanie zatrzymać propagacje eventu, jeżeli użyjemy jednej z następujących metod:
 - stopPropagation() – zatrzymuje propagacje eventu w górę drzewa DOM (callbacki rodziców nie zostaną uruchomione).
 - stopImmediatePropagation() – zatrzymuje propagacje eventu oraz każdy inny event, który powinien zostać uruchomiony.

 -----

#preventDefault():
 Możemy zapobiec domyślnej akcji eventu np.

 $('a').on('click', function() {
     // jakaś akcja po kliknięciu, np. przeniesienie
     // pod adres znajdujący się w href
   });

 $('a').on('click', function(event) {
     event.preventDefault();
     // jakaś akcja po kliknięciu, np. przeniesienie
     // pod adres znajdujący się w href zostanie anulowana
   });


 -----

#preventDefault() vs return false
 -preventDefault() - zapobiega domyślnej akcji eventu np.:
 $('a').on('click', function(event) {
   event.preventDefault();
   });

 -return false - zapobiega domyślnej akcji eventu oraz zapobiega propagacji eventu w górę.
 $('a').on('click', function(event) {
   return false;
   });

 Przykład: http://jsfiddle.net/CodersLab/cw7z5g9x


 -----

#on() - Metoda on zaczepia określony event do elementu jQuery.

 $(elements).on(events [, selector] [, data], handler)

 Gdzie:
 - events to typ eventu, może być jeden lub więcej,
 - selector – to opcjonalny parametr, określa selektory, na których możemy zaczepić event, a których np. nie ma jeszcze w dokumencie,
 - data – to również opcjonalny parametr. Możemy przekazać do funkcji handler jakieś dane np. {foo: "bar"},
 - handler – to funkcja, która zostanie wykonana w momencie wywołania eventu.


 Przykład dla on():
 $('.menu').find('li').on('click', function() {
    // jakaś akcja po kliknięciu
   });

 -dla każdego elementu, który znajdziesz, ustaw event click.
 -dla każdego elementu, który ma ustawiony event, zostaje przypisana funkcja anonimowa.
 -funkcja ta zostanie wywołana dopiero wtedy, gdy event click zostanie wywołany.

 Przykład 2:
 <button id="ourButton">Click me!</button>

 $('#ourButton').on('click', function (event) {
    alert('You clicked me!');
  });

 Pierwsze kliknięcie: 'You clicked me!'
 Drugie kliknięcie: 'You clicked me!'

 -----

#one() - Metoda one zaczepia określony event do elementu jQuery tylko raz.

 $(elements).one(events [, selector] [, data], handler);  //te same parametry co on()

 Przykład dla one():
 $('.menu').find('li').one('click', function() {
   // jakaś akcja po kliknięciu
  });

 Przykład 2:
 <button id="ourButton">Click me!</button>

 $('#ourButton').one('click', function (event) {
    alert('You clicked me!');
  });

 Pierwsze kliknięcie: 'You clicked me!'
 Drugie kliknięcie: Nic się nie wyświetla, ponieważ użyliśmy metody one

 -----

#off() - Metoda off odczepia określony event od elementu jQuery.

 $(elements).off([ events ] [, selector] [, handler]);

 -Wszystkie parametry są opcjonalne.
 -Wywołanie samego $(element).off() usunie wszystkie eventy z elementu.

 Przykład dla off():
 $('.menu').find('li').on('click', function() {
   // jakaś akcja po kliknięciu
  });

 $('.menu').find('li').off('click');


 Przykład 2:
 <button id="ourButton">Click me!</button>

 $('#ourButton').on('click', function (event) {
    alert('You clicked me!');
  });

 $('#ourButton').off('click');

 // Nic się nie wyświetla, ponieważ odpięliśmy event.


 ------

#Najpopularniejsze eventy:

 Mouse Events:
 -click – kliknięcie
 -dblclick – podwójne kliknięcie
 -mouseenter – najechanie
 -mouseleave – zjechanie

 KeyBoard Events:
 -keypress – wciśnięty klawisz (klawisze specjalne)
 -keydown – wciśnięty klawisz
 -keyup – zwolniony klawisz

 Form Events:
 -submit – kliknięty submit
 -change – zmiana elementu
 -focus – focus na elemencie
 -blur – utrata eventu focus

 Document/Window Events:
 -load – ładowanie dokumentu
 -resize – zmiana wielkości okna
 -unload – event po opuszczeniu przez użytkownika strony (blokowany przez niektóre przeglądarki, możesz użyć onbeforeunload)
 -scroll – scrollowanie
 */


//-------------------------

//PRZYKŁADY:

/**
 Zadanie :
 Znajdź w pliku index.html trzy buttony w elemencie o klasie hero-buttons. Stwórz funkcję, w której wykonaj następujące czynności:

 ustaw każdy z trzech przycisków pod inną zmienną,
 dla elementu pierwszego ustaw event click, który po kliknięciu wyświetli w konsoli napis "kliknięto mnie",
 dla elementu drugiego ustaw event click, który po kliknięciu wyświetli w konsoli napis "kliknięto mnie, ale już drugi raz nie dam się kliknąć",
 dla trzeciego wywołaj metodę off, która odczepi wszystkie eventy z wszystkich przycisków.

 KOD HTML:
 <div class="hero-buttons">
 <button class="ironMan-btn">Iron Man</button>
 <button class="thor-btn">Thor</button>
 <button class="wolverine-btn">Wolverine</button>
 </div>
 */

$(document).ready(function() {

    var ironMan = $('.ironMan-btn');
    var thor = $('.thor-btn');
    var wolverine = $('.wolverine-btn');

//można tak: ironMan.click...
    ironMan.on('click', function (e) {
        console.log('Kliknięto mnie');
    });

    thor.one('click', function (e) {
        console.log('nie dam się drugi raz kliknąć');
    });

    wolverine.click(function(e) {
        //console.log('asda');
        var buttons = $('.hero-buttons').find('button');
        buttons.off('click');
    });


});


/**
 Zadanie 2:
 W pliku counter.html znajduje się pusty formularz, umieść w nim pole textarea. Poniżej pola ma znaleźć się licznik wpisanych aktualnie znaków w to pole np. 63/100. Licznik ma zwiększać i zmniejszać swoją wartość po każdym wpisanym/usuniętym znaku. Zablokuj możliwość wpisania więcej niż 100 znaków w to pole.

 Napis z liczbą wpisanych znaków ma zmieniać kolor:
 kolor fontu 	liczba wpisanych znaków
 zielony 	0–33
 niebieski 	34–66
 czerwony 	67–100

 KOD HTML:
 <form action="#">

 <textarea id="text" maxlength="100"></textarea>
 <div id="counter">0/100</div>
 </form>

 */


$(document).ready(function() {

    var counter = $('#counter');
    var textArea = $('#text');

    textArea.on('keyup', function (e) {
        //console.log('aa');

        var currentLenght = $(this).val().length;  //sprawdza długość już wpisanego tekstu
        counter.text(currentLenght + "/ 100");
        if (currentLenght <34) {counter.css('color','green'); textArea.css('color', 'green');}
        if (currentLenght >33 && currentLenght <67) {counter.css('color','blue');}
        if (currentLenght >66) {counter.css('color','red');}
    });


});



/**
 Zadanie 3:
 Znajdź w pliku html sekcję o klasie superhero-description, a następnie napisz funkcję, w której:

 Ukryj domyślnie wszystkie elementy dd.
 Po kliknięciu w element dt spraw, by elementy dd:

 rozwijały się, jeśli są ukryte,
 zwijały się, jeśli są widoczne.


 KOD HTML:
 <section class="superhero-description">
 <dl>
 <dt>Iron Man</dt>
 <dd>
 Iron Man jest superbohaterem, który walczy ze zbrodnią za pomocą skonstruowanych
 przez siebie serii cybernetycznych zbroi, wyposażonych w najnowocześniejsze technologie.
 Jako Tony Stark prowadzi życie bogatego przedsiębiorcy i filantropa,
 kierującego konglomeratem Stark Industries. Jest członkiem elitarnej grupy
 superherosów o nazwie Avengers.
 </dd>


 <dt>Thor</dt>
 <dd>
 Thor został stworzony przez Stana Lee, Jacka Kirby’ego i Larry'ego Liebera.
 Pierwszy raz postać ta pojawiła się w roku 1962, w Journey into Mystery vol. 1 #83.
 Postać oparta jest na Thorze, bogu z mitologii nordyckiej.
 Thor jest jednym z założycieli Avengers, członkiem grupy we wszystkich czterech
 wydaniach komiksu.
 </dd>
 <dt>Wolverine</dt>
 <dd>
 Wolverine jest pochodzącym z Kanady mutantem, którego cechuje zdolność
 szybkiej regeneracji uszkodzonych tkanek ciała. Ma kostne szpony chowane w
 przedramionach obu rąk (później jego szkielet i szpony zostały zespolone z adamantium).
 Jego pseudonim tłumaczy się na język polski jako „rosomak”, co wiąże się z jego dziką naturą.
 Należał do grup X-Men, The Avengers i Alpha Flight.
 </dd>
 </dl>
 </section>

 CSS:
 .hide { display: none;}

 */


$(document).ready(function() {

    $('.superhero-description').find('dd').addClass('hide');
    $('.superhero-description').find('dt').on('click',function (e) {
        //$('.superhero-description').find('dd').toggleClass('hide'); //zwiną/rozwiną się wszystkie
        //$(this).next().next().toggleClass('hide');//przykład - gdybyśmy mieli pod każdym dt 2 razy dd, to zamnkniemy ten drugi
        $(this).next().toggleClass('hide');
    });


});



/**
 Zadanie 4:
 W pliku index.html znajdź formularz o klasie login. W pliku app.js stwórz funkcję, która będzie reagować na wciśnięcie przycisku show-hide-btn. Na początek ustaw event tak, aby po wciśnięciu wypisał w konsoli "działam". Następnie funkcja ma sprawdzać, jakiego typu jest element przechowujący hasło. Jeśli password – zmień type na text. Jeśli text – zmień na password.

 KOD HTML:
 <form class="login">
 <label> Podaj swoje imię:
 <input value="" type="text" class="user-name">
 </label>
 <br>
 <label> Podaj hasło:
 <input value="" type="password" class="user-pass">
 <button class="show-hide-btn">Pokaz/Ukryj hasło</button>
 </label>
 </form>
 */

$(document).ready(function() {

    var showHideBtn = $('.show-hide-btn');
    showHideBtn.on('click', function (e) {
        //console.log ('dzialam');

        var userPass = $('.user-pass');
        //console.log(userPass.attr('type')); - pokazuje jaki jest typ atrybutu
        if (userPass.attr('type') == "password") {
            userPass.attr('type', 'text');
        } else {
            userPass.attr('type', 'password');
        }

        e.preventDefault();
    });
});



/**
 Zadanie 5:
 Po najechaniu kursorem myszy na element w menu wypisz w konsoli tekst "Hura".

 KOD HTML:
 <nav class="menu">
 <a href="#">Start</a>
 <a href="#">About heros</a>
 <a href="#">Portfolios</a>
 <a href="#">Contact</a>
 </nav>
 */

$(document).ready(function() {
    var menu = $('.menu');
//menu.on('mouseenter', function (e) { //tak samo działa jak mouseover
    menu.on('mouseover', function (e) {
        console.log ('Hura');
    });

});



/**
 Zadanie 6:
 Znajdź w pliku index.html formularz o klasie login, a następnie napisz funkcję, w której:

 ustaw lekki cień wewnętrzny po kliknięciu wewnątrz inputa,
 zmień background-color na szary po wyjściu kursorem z pola input.
 np. box-shadow: inset 5px 5px 10px;

 KOD HTML:
 <form class="login">
 <label> Podaj swoje imię:
 <input value="" type="text" class="user-name">
 </label>
 <br>
 <label> Podaj hasło:
 <input value="" type="password" class="user-pass">
 <button class="show-hide-btn">Pokaz/Ukryj hasło</button>
 </label>
 </form>

 */

$(document).ready(function() {

    var login = $('.login').find('input');
    console.log(login);
    login.on('focus', function (e) {
        console.log('kliknalem');

        //$(this).
        $(this).css('background-color', 'red');
    });

    login.on('blur', function (e) {
        $(this).css('background-color', 'grey');
    });


});