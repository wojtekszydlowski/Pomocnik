/**
#DOŁĄCZANIE jQuery

 Na stronie http://jquery.com/download/ i pobieramy np. Download the uncompressed, development jQuery 3.2.1
 W pliku html dajemy linię: <script src="js/jquery-3.2.1.js"></script> - ważna jest kolejność - najpiej jak najwyżej - najpierw ładujemy jQuery

 lub

 Drugi sposób załadowania kodu z https://code.jquery.com/ i wybieramy link jQuery Core 3.2.1 - uncompressed i wtedy pobieramy kod

 <script
 src="https://code.jquery.com/jquery-3.2.1.js"
 integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
 crossorigin="anonymous"></script>

 ----

#DOMContentLoaded w jQuery

 $(document).ready(function() {
  kod: np.: alert ('działa');
  });

 ----

#Wyszukiwanie elementów

 // Znajdź element o id top:
 $('#top');

 // Znajdź wszystkie elementy li:
 $('li');

 // Znajdź wszystkie elementy li wewnątrz ul
 $('ul li');

 // Znajdź wszystkie elementy z klasą boxes
 $('.boxes');

 //Znajdź wszystkie elementy, które mają klasę a lub klasę b
 $('.a, .b');

 //Znajdź wszystkie elementy, które mają klasę a i b razem (ważne - zapis bez żadnych spacji musi być)
 $('.a.b');

 //Znajdź wszystkie elementy, które mają id a oraz jednocześnie klasy a i b
  $('#a.b.c')

 //Znajdź element li o klasie item-a
 $( "li.item-a" )

 //Przykłady:
 $('.menu a'); - jQuery znajduje wszystkie elementy a, następnie sprawdza, które z nich mają rodzica z klasą menu
 $('.menu').find('a'); - to samo co wyżej tyle ża najpierw szuka klasy .menu a później elementy a

 $('.menu').find('a').css('color', 'red'); - dodaje znalezionym elementom kolor czerwony
 $('.menu').find('a').addClass('crazyColors'); - dodaje klasę crazyColors znalezionym elementom a w klasie menu
 $('.menu').find('a').removeClass('crazyColors'); - usuwa klasę crazyColors znalezionym elementom a w klasie menu
 $('.menu').find('a').toggleClass('crazyColors'); - dodaj, jeśli nie ma, lub usuwa, jeśli jest, klasę crazyColors

 ----

#Sprawdzanie czy element ma klasę: za pomocą funkcji hasClass()

 if ($('.menu').hasClass('crazyColors')) {
   console.log('Menu ma klasę crazyColors');
   } else {
   console.log('Menu nie ma klasy crazyColors');
   }

 ----

#Znikanie i pojawianie się elementu:

 fadeIn() – pojawienie się ukrytego elementu z efektem przenikania
 fadeOut() – zniknięcie widocznego elementu z efektem przenikania

 $('.menu').find('a').fadeIn('slow');
 $('.menu').find('a').fadeOut(1000);

 ----

#Ustawianie atrybutów elementów

 Możemy pobierać i ustawiać atrybuty elementów (class, id, type) za pomocą funkcji attr():

 <input value="" type="text" class="user-name">

 var userName = $('input.user-name');
 userName.attr('type'); //pobiera - sprawdza jaki atrybut type ma element o klasie user-name
 userName.attr('type', 'password'); - ustawia atrybut type na password - ze zwykłego tekstu zmienił na password (kropkowany)

 ----

#each():

 each(index, element) - pętla, która iteruje po elementach znalezionych w DOM-ie. Index zawiera numer kolejnego elementu, a element to obiekt tego elementu.

 Przykład:

 KOD HTML:
 <a href="http://jsfiddle.net">JSFiddle</a>
 <a href="http://codepen.io">CodePen</a>
 <a href="http://jsbin.com">JS Bin</a>

 jQuery:
 var links = $('a');
 links.each(function (index, element) {
   console.log($(this).attr('href'));
  });

 W jQuery działa również this reprezentujące bierzący  element ale musimy stworzyć z niego obiekt jQuery poprzez $(this).


 -----
#Zaawansowane wyszukiwanie elementów:

 -find() – znajduje elementy, które są zagnieżdżone w innym,
 -closest() – znajduje elementy najbliższe o zadanej klasie lub id, - idzie wyżej
 -children() – znajduje wszystkie dzieci danego elementu,
 -parent() – znajduje rodzica elementu,
 -siblings() – znajduje rodzeństwo elementu,
 -next() – znajduje następny element
 -prev() – znajduje poprzedni element.


 */


//PRZYKŁADY:

/**
 Zadanie - Zapoznaj się z plikiem index.html oraz plikiem style.css. Dodaj klasę borderClass do każdego elementu li w elemencie section class="main". Pamiętaj, aby wykonać to w odpowiedniej funkcji. Znajdź wszystkie elementy o klasie showMore. Pierwszemu z tych elementów zmień kolor fontu css() na różowy.
 */

$(document).ready(function() {
    $('.main').find('li').addClass('borderClass');
    $('.showMore').first().css('color','pink');  //first() - zwraca pierwszy element
    //można też zapisać to inaczej z użyciem eq
    //$('.showMore').eq(0).css('color','pink');

    //drugi element li z klasy menu - nadaj mu kolor czerwony używając css
    //console.log($('.menu li(2)').css('color','red');
    $('.menu').find('li').eq(1).css('color','red');
    //$('.menu').find('li').eq(-1).css('color','red'); - poerwszy od końca wtedy zmieni
});


//----


/**
 Zadanie - Ustaw każdemu elementowi li (tylko te w sekcji o klasie main) dodatkowe dwie klasy:

 colorText,
 backgroundElement. Znajdziesz je w pliku style.css pod odpowiednim komentarzem. Łącznie z poprzednią klasą borderClassbędą to trzy klasy ustawione dla każdego li. Ustaw także dla tych elementów następujące funkcje:
 fadeOut z bardzo wolnym zanikaniem,
 fadeIn z bardzo wolnym pojawianiem.

 */

$(document).ready(function() {
    $('.main').find('li').addClass('colorText');
    $('.main').find('li').addClass('backgroundElement');


    $('.main').find('li').fadeOut(3000);
    $('.main').find('li').fadeIn(3000);
});



//----

/**
 Zadanie 4 - Za pomocą jQuery wykonaj następujące operacje:

 Wyszukaj wszystkie linki i ustaw im czerwony kolor za pomocą funkcji css().
 Zmodyfikuj kod tak, aby kolor czerwony miały linki tylko z menu.
 Dodaj klasę redLinks w pliku style.css (ustaw w niej kolor tekstu na czerwony) i za pomocą addClass nadaj ją elementom li w menu (zmodyfikuj kod z podpunktów 1. i 2.).
 Spraw, aby pierwszy element menu miał większy font niż inne. Stwórz odpowiednią klasę w pliku style.css. Pamiętaj, aby wykonać to w odpowiedniej funkcji.

 */

$(document).ready(function() {
    //$('a').css('color','red');  - tu wszystkie linki będą miały kolor czerwony
    $('.menu').find('a').css('color','red');

    $('.menu').find('a').first().css('font-size','20px');

});

//----

/**
 Zadanie 5 - Sprawdź, czy h1 ma klasę creepyHeader.

 Jeśli nie ma – dodaj ją do tego elementu.
 Jeśli ma – wypisz w konsoli, że nagłówek ma już taką klasę.

 */
$(document).ready(function() {
    var h1= $('#naglowek');
    console.log(h1);
    if (h1.hasClass('creepyHeader')) {
        console.log('Ma klasę creepyHeader');
    } else {
        //console.log('Nie ma klasy creepyHeader');
        $('.main').find('h1').addClass('creepyHeader');

        //console.log($('h1'));
        console.log('Dodano klasę creepyHeader');
    }
});

//----


/**
 Zadanie: Znajdź w pliku index.html element o klasie shopping, a następnie wykonaj poniższe czynności:

 Po kliknięciu w przycisk Dodaj ustaw mu klasę added, oraz pojedynczemu elementowi div zawierającemu produkt zmieni obramowanie na zielone.
 Po ponownym kliknięciu zresetuj ustawienia elementu

 KOD HTML:
 <section class="shopping">
 <div class="cart-item">
 <p class="item-desc">Pasta do zębów</p>
 <p class="item-qty">1</p>
 <div class="update-container">
 <button>Dodaj</button>
 </div>
 </div><!-- end cart-item -->

 <div class="cart-item">
 <p class="item-desc">Książka</p>
 <p class="item-qty">1</p>
 <div class="update-container">
 <button>Dodaj</button>
 </div>
 </div><!-- end cart-item -->

 <div class="cart-item">
 <p class="item-desc">Buty</p>
 <p class="item-qty">2</p>
 <div class="update-container">
 <button>Dodaj</button>
 </div>
 </div><!-- end cart-item -->
 </section>
 */

$(document).ready(function() {
    var buttons = $('.shopping').find('button');
    buttons.on('click', function () { //metoda do zakładia eventów - on
        //buttons.click (function () { - inny zapis tego samego

        //aby przy ponownym kliknięciu zresetować ustawienia powinniśmy sprawdzić czy przycisk ma ustawioną klasę
        if ($(this).hasClass('added'))
        {
            //console.log('ma');
            $(this).parent().parent().css('border', 'solid 1px black');
            $(this).removeClass('added');
        }
        else
        {
            $(this).addClass('added');
            //$(this).css
            //teraz musimy wyszukać dziadka (rodzica rodzica), bo jesteśmy w sekcji button
            $(this).parent().parent().css('border', 'solid 5px green');
        }
        /*
         To samo rozwiązanie z zasosowaniem toggleClass
         Do pliku css musimy dodać klaśe:
         .greenBorder {border: solid 2px green; }

         buttons.on('click', function () {
         $(this).toggleClass('added');
         $(this).parent().parent().toggleClass('greenBorder');
         }

         */

    });
})



//------------


/**
 Zadanie: Znajdź w pliku index.html element o klasie films, zmień kod następująco:

 Po kliknięciu w przycisk rozwiń, rozwinie się opis filmu.
 Po kliknięciu w przycisk zamknij, zwinie się opis filmu (tylko ten, który chcemy zwinąć, nie wszystkie).
 Po kliknięciu w zamknij, zwiną się wszystkie opisy.

 KOD HTML:
 <section class="films">
 <ul>
 <li>
 <h2>Film 1 <a class="expand" href="">rozwiń</a></h2>
 <div class="container">
 <p>Harry Poter i insygnia śmierci</p>
 <a class="close" href="#">Zamknij</a>
 </div>

 </li>
 <li>
 <h2>Film 2 <a class="expand" href="">rozwiń</a></h2>
 <div class="container">
 <p>Uniwersytet potworny</p>
 <a class="close" href="#">Zamknij</a>
 </div>
 </li>
 <li>
 <h2>Film 3 <a class="expand" href="">rozwiń</a></h2>
 <div class="container">
 <p>Milczenie owiec</p>
 <a class="close" href="#">Zamknij</a>
 </div>
 </li>
 </ul>
 </section>
 */

$(document).ready(function() {

// var links = $('.films').find('a');
//     var links = $('.films').closest('.expand').find('a');
// //var links = $('.films').children('.expand').find('a'); - nie działą
// console.log(links);
//
// //skorzystać z prevent deafult


    $('.films').find('.expand').click(
        function(e) {
            $(this).parent().parent().find('.container').fadeIn('slow');//musimy się odwołać do dziadka (do li), bo tam jest .container
            //można też zrobuć z closest np.
            //$(this).closest('li').find('.container').fadeIn('slow');

            //$(this).parent().parent().find('.container').css('display','block'); // inny sposób otwierania
            //return false; //stop proganacji - link nie odświeży strony
            e.preventDefault();//drugi sposób

        }
    );


    $('.films').find('.container').find('.close').click(
        function(e) {
            //$('.films').find('.container').fadeOut('slow');//tu zwija wszystkie opisy
            $(this).parent().parent().find('.container').fadeOut('slow');//to zamyka tylko jeden opis
            e.preventDefault();
        }
    );

});

//To samo zapisane inaczej - dodane funkcje
/*
 function changeCounter()
 {
 var count = $(this).val().length;
 $('#counter').text(count + "/100");
 }
 function changeColor()
 {
 var count = $(this).val().length;
 var green = 33;
 var orange = 66;

 if (count <= green){
 $(this).css('color', 'green');
 }else if (count <= orange){
 $(this).css('color', 'orange');
 }else{
 $(this).css('color', 'red');
 }


 }
 $(document).ready(function () {
 textarea = $('#textarea');
 textarea.on({'keyup': changeCounter,
 'keydown': changeCounter});
 textarea.on({'keyup': changeColor,
 'keydown': changeColor});
 });