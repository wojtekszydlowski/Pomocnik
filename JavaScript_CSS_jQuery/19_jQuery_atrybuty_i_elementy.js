/**
#Atrybuty:
 Możemy łatwo wczytywać lub modyfikować atrybuty elementów dzięki następującym metodom:

 -attr(name, newValue) – pobierz lub ustaw atrybut elementu,
 -removeAttr(name) – usuń atrybut elementu,

 Każda z tych metod może nastawiać atrybut (jeżeli podamy nową wartość) attr(name) lub zwracać jego wartość (jeżeli podamy tylko nazwę).

 Przykład:

 HTML:
 <div class='footer' id='plan'>O nas</div>

 JavaScript:
 var elementID = $('.footer').attr('id'); // id=plan
 var elementID = $('.footer').removeAttr('id');

 HTML:
 <div class='footer'>O nas</div>

 -----

#Metoda prop():
 -prop – również sprawdza własności (properties) elementu.
 -jest używany podczas pobierania atrybutów boolean oraz własności nieistniejących w dokumencie HTML.
 -Wszystkie inne atrybuty powinno się pobierać za pomocą attr().

 Przykład:

 HTML:
 <input type=”checkbox" value="test" id="test"/>

 JavaScript:
 $('#test').prop('checked');  //jeśli jest zaznaczony poda tru, jeśli nie false


 -----

#Atrybut data:
 Możemy nastawiać lub odczytywać atrybut data za pomocą metody data(dataSet, value).

 Przykład:
 <div data-role="page" data-last-value="43" data-hidden="true">
 </div>

 $("div").data("role") ; //"page"
 $("div").data("lastValue"); //43
 $("div").data("hidden"); // true
 $("div").data("options", "new option" );


 -----

#Pobieranie i wstawianie tekstu do elementu:
 -html() – wstawia/ustawia tekst lub HTML (zrenderowany)
 -text() – wstawia/ustawia tekst lub HTML (jako string, np. <em>Tekst</em> )

 Przykład:

 KOD HTML:
 <div id="div1"></div>
 <div id="div2"></div>

 JavaScript:
 $("#div1").html('<a href="example.html">Link</a><b>hello</b>'); //wypisze w przeglądarce podlinkowany link
 $("#div2").text('<a href="example.html">Link</a><b>hello</b>'); //wypisze w przeglądarce <a href="example.html">Link</a><b>hello</b> jako tekst

 -----

#Tworzenie nowych elementów:
 var newDiv = $("<div>");  //<div>​</div>
 var newDiv = $("<div>Tekst, który wyświetlamy</div>");  // <div>​Text który wyświetlamy​</div>
 var newDiv = $("<div class = 'class1 foo' id='newDiv'>"); //<div class=​"class1 foo" id=​"newDiv">​</div>
 var newDiv = $("<div>", {id: "myId", class: "class1 class2"}); //<div id=​"myId" class=​"class1 class2">​</div>

 -----

#Dodawanie elementów do DOM-u:
 Tak samo jak w przypadku czystego JavaScript po utworzeniu elementu należy go jeszcze podpiąć do DOM-u.
 jQuery udostępnia nam bardzo dużo metod, dzięki którym możemy łatwo podpiąć element w wybranym miejscu. Są to:
 -after,
 -before,
 -append,
 -appendTo,
 -prepend,
 -prependTo,
 -insertAfter,
 -insertBefore,
 -wrap.

 -----

#Wstawianie elementu przed lub po: metody before() i after().

 Przykład:
 // <p class="bar">Hello</p>
 var firstOfBar = $(".bar").first();
 var newElement = $("<div class='new'> This is new element</div>");

 firstOfBar.after(newElement);
 // <p class="bar">Hello</p>
 // <div class="new"> This is new element</div>

 firstOfBar.before(newElement);
 // <div class="new"> This is new element</div>
 // <p class="bar">Hello</p>



 -----

#Dodawanie elementu do dzieci:
 Możemy łatwo dodać element do dzieci innego elementu dzięki następującym metodom:
 -append(newElement) – wstaw nowy element na koniec dzieci już istniejącego elementu,
 -appendTo(oldElement) – odwrotność (czyli wywołujemy na nowym elemencie i podajemy, gdzie ma się dodać).

 -prepend(newElement) – wstaw nowy element na początek dzieci już istniejącego elementu,
 -prependTo(oldElement) – odwrotność.

 Przykład:

 Kod HTML:
 <div class="foo" id="fooId" style="color: red;">
  <p class="bar">Hello</p>
 </div>

 Kod JavaScript:
 var newElement = $("<div class='new'> This is new element</div>");
 var foo = $("#fooId");

 Przypadek 1:
 foo.append(newElement);
 W przeglądarce będziemy mieli:
 <div class="foo" id="fooId" style="color: red;">
 <p class="bar">Hello</p>
 <div class="new"> This is new element</div>
 </div>

 Przypadek 2:
 foo.prepend(newElement);
 W przeglądarce będziemy mieli:
 <div class="foo" id="fooId" style="color: red;">
 <div class="new"> This is new element</div>
 <p class="bar">Hello</p>
 </div>

 -----

#Usuwanie elementów z DOM-u:
 Oto kilka metod ułatwiających usunięcie elementów z DOM-u. Co ważne, jedna z metod pozwala nam odczepić element bez jego niszczenia:
 -remove() – usuń element,
 -detach() – wypnij element z drzewa DOM bez usuwania go i zwróć go (np. żebyśmy mogli zapisać go do zmiennej),
 -empty() – usuń wszystko ze środka elementu

 Przykład:


 KOD HTML:
 <div class="foo" id="fooId" style="color: red;">
  <p class="bar1">Hello1</p>
  <p class="bar2">Hello2</p>
  <p class="bar3">Hello3</p>
 </div>

 $(".bar1").remove(); - da nam w przeglądarce:
 <div class="foo" id="fooId" style="color: red;">
  <p class="bar2">Hello2</p>
  <p class="bar3">Hello3</p>
 </div>

 var removedBar2 = $(".bar2").detach();
 // możemy zapisać do zmiennej

 <div class="foo" id="fooId" style="color: red;">
  <p class="bar3">Hello3</p>
 </div>

 $("#fooId").empty();
 <div class="foo" id="fooId" style="color: red;"></div>




 */


//PRZYKŁADY:


/**
 Zadanie 1:
 Znajdź w pliku index.html element o klasie people. Stwórz odpowiednią funkcję, wewnątrz której ustaw event click na przycisku dodaj. Po kliknięciu wykonaj następujące czynności:

 Pobierz do zmiennej wartość wpisaną do pola o id addUser.
 Pobierz do zmiennej wartość wpisaną do pola o id age.
 Wstaw nowy element na koniec listy, ustaw jej wiek jako atrybut data.
 Po każdym wstawieniu elementu wywołaj osobną funkcję, która będzie ustawiała dany kolor dla elementu li w następujący sposób:

 zielony dla osób w wieku do 15 lat,
 niebieski dla osób mających od 16 do 40 lat,
 brązowy dla osób mających 41 lat i więcej.

 KOD HTML:
 <section class="people">
 <input type="text" placeholder="Wpisz imię i nazwisko" id="addUser"/>
 <input type="text" placeholder="Wpisz wiek" id="age"/>
 <input type='submit' value='dodaj'>

 <ul class="main">
 <li data-age="63">John Travolta</li>
 <li data-age="18">Angelina Jolie</li>
 <li data-age="50">Barack Obama</li>
 <li data-age="15">Krzysztof Ibisz</li>
 </ul>
 </section>

 */

function changeColor(element, age){
    var green = 15;
    var blue = 40;

    if (age <= green) {
        element.css('color','green');
    } else if (age <= blue) {
        element.css('color', 'blue');
    } else {
        element.css('color', 'brown');
    }
}
$(document).ready(function() {

    //var people = $('.people');
    var button = $('.people').find('input[type=submit]');
    console.log(button);

    button.on('click', function (e) {
        var addUser = $('#addUser').val(); //pobiera wartość z pola input addUser
        var age = $('#age').val(); //pobiera wartość z pola input age

        var newLi = $('<li data-age="' + age + '">' + addUser + '</li>');
        //console.log(newLi);
        $('.main').append(newLi); //dodaje na końcu listy nowe nazwisko wraz z wiekiem jako atrybut data
        changeColor(newLi, age);


    });


});


//-----------


/**
 Zadanie 2:
 Znajdź w pliku index.html element o klasie where-i-am, następnie stwórz odpowiednią funkcję, wewnątrz której stwórz elementy span i dodaj je w odpowiednie miejsca według obrazka poniżej. W miejsce trzech kropek wstaw nazwę funkcji, której używasz, np. Jestem tutaj append. Nie zmieniaj kodu HTML.

 Rysunek: https://github.com/wojtekszydlowski/WRO_PHP_W_01_JavaScript/tree/master/1_Zadania/Dzie%C5%84_4/4_Modyfikowanie_elementow

 */

function createSpan (){
    var whereIAm = $('.where-i-am');
    var whereIAmDiv = $('.where-i-am').find('div');
    //stworzyć element span
    whereIAm.append($('<span>4. Jestem tutaj append</span>'));
    var span2 = '<span>3. Jestem tutaj before</span>';
    whereIAmDiv.before(span2);

    var whereIAmP = whereIAm.find('p');
    var span3 = '<span>2. Jestem tutaj before</span>';
    whereIAmP.before(span3);
    var span4 = '<span>1. Jestem tutaj after</span>';
    whereIAmP.after(span4);



}

$(document).ready(function() {


    createSpan();


});

/*
 Zadanie 2 - robione przez wykładowcę:

 function createSpan(){
 var whereIam = $('.where-i-am');

 whereIam.append(
 $('<span>Jestem tutaj append</span>'));
 whereIam.prepend(
 $('<span>Jestem tutaj prepend</span>'));
 whereIam.find('p').before(
 $('<span>Jestem tutaj before</span>'));
 whereIam.find('p').after(
 $('<span>Jestem tutaj after</span>'));
 }


 function changeColor(element, age){
 var green = 15;
 var blue = 40;

 if (age <= green){
 element.css('color', 'green');
 }else if (age <= blue){
 element.css('color', 'blue');
 }else{
 element.css('color','brown');
 }
 }
 $(document).ready(function () {
 $('.people')
 .find('input[type=submit]')
 .click(function (e) {
 var addUser = $('#addUser').val();
 var age = $('#age').val();
 var newLi = $('<li data-age="' +
 age + '">' +
 addUser + '</li>');
 $('.main').append(newLi);
 changeColor(newLi, age);
 });
 createSpan();
 });

 */