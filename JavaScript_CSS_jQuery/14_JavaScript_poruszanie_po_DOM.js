/**
 Poruszanie się po drzewie DOM:

 Dzięki odpowiednim metodom elementów możemy się swobodnie poruszać po całym dokumencie. W drzewie rozróżniamy trzy ważne nazwy:
 -rodzic (parent),
 -brat (sibling),
 -dziecko (child).

 # Poruszanie się w górę:
 Poruszanie się w górę drzewa jest najłatwiejsze – istnieje tylko jedna ścieżka, którą możemy pójść, a wyznacza ją rodzic (parent) elementu.
 Żeby uzyskać element rodzica, należy użyć atrybutu: parentElement

 Przykład:
 <div id="foo">
  <span id="bar">Bar</span>
 </div>

 var barElement = document.querySelector('#bar');
 var barParent = barElement.parentElement;

 ---

 # Poruszanie się na boki:

 Mamy dwie możliwości poruszania się na boki w drzewie DOM:
 -el.nextElementSibling – zwraca następny element mający tego samego rodzica,
 -el.previousElementSibling – zwraca poprzedni element mający tego samego rodzica.

 Funkcje te mogą zwrócić NULL w przypadku w którym nie ma poprzedniego / następnego elementu.

 Przykład:
 <div id="foo">
  <span id="bar">Bar</span>
  <span id="baz">Baz</span>
  <span id="buz">Buz</span>
 </div>

 var bazElement = document.querySelector('#baz');
 var bar = bazElement.previousElementSibling;
 var buz = bazElement.nextElementSibling;

 ---

 # Poruszanie się w dół drzewa:
 Jeśli poruszamy się w dół drzewa, to mamy do wyboru wszystkie dzieci danego elementu. Możemy użyć następujących atrybutów:
 -el.children – zwraca tablicę wszystkich dzieci,
 -el.firstElementChild – zwraca pierwsze dziecko,
 -el.lastElementChild  – zwraca ostatnie dziecko.

 Przykład:
 <div id="foo">
  <span id="bar">Bar</span>
  <span id="baz">Baz</span>
  <span id="buz">Buz</span>
 </div>

 var fooElement = document.querySelector('#foo');
 var allChildren = fooElement.children;
 var bar = fooElement.firstElementChild; // lub allChildren[0]
 var buz = bazElement.lastElementChild; // lub allChildren[allChildren.length - 1]

 */



//PRZYKŁADY:

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

document.addEventListener('DOMContentLoaded', function () {

    var listContainers = document.querySelectorAll(".listContainer");
    for (var i=0; i<listContainers.length; i++){
        listContainers[i].addEventListener("mouseover", function (e) {
            var childrens = this.children; //mamy listę wszystkich dzieci danego diva
            //var childrens = e.children;

            for (var j=0; j<childrens.length; j++) {
                childrens[j].style.color = "green";
            }
            this.firstElementChild.firstElementChild.style.color = "red"; //bo musimy się odwołać do dziecka dziecka (wnuka) - dzieckiem diva o klasie listContainer jest ul, a my potrzebujemy dzieci elementów div
            this.firstElementChild.lastElementChild.style.color = "blue";
        });
    }

});


//--------------



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

 */



document.addEventListener('DOMContentLoaded', function () {
    var buttons = document.querySelectorAll(".button");
    for (var i=0; i<buttons.length; i++) {
        buttons[i].addEventListener("click", function (e) {
            var nextSibbing = this.nextElementSibling;
            if (nextSibbing != "Null") {nextSibbing.className = "hidden";}
            console.log(nextSibbing);
        });
    }
});



//---------------

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



document.addEventListener('DOMContentLoaded', function () {
    var buttons = document.querySelectorAll(".button");
    for (var i=0; i<buttons.length; i++) {
        buttons[i].addEventListener("click", function (e) {
            var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16);
            var parent = this.parentElement;
            parent.style.backgroundColor = randomColor;
            //console.log(nextSibbing);
        });
    }
});


//-------


/**
 Znajdź i zapisz do zmiennych następujące elementy:

 Element o klasie first -> jego pierwsze dziecko -> jego trzecie dziecko.
 Element o id second -> jego rodzic -> jego czwarte dziecko.
 Element o atrybucie data-ex nastawionym na wartość third -> jego dziadek -> jego ostatnie dziecko -> jego pierwsze dziecko -> jego środkowe dziecko (żeby otrzymać środkowy element, podziel liczbę dzieci przez dwa i zaokrąglij w górę).
 Div o klasie forth -> jego rodzic -> jego pierwsze dziecko o tagu article -> jego drugie dziecko o tagu <p>.

 Wszystkie te elementy mają atrybut data-answer nastawiony na numer zadania, dla którego są odpowiedzią. Sprawdź przez wyświetlenie w konsoli wartość tego atrybutu. Dzięki temu będziesz wiedział, czy dane polecenie wykonałeś prawidłowo.
 */


document.addEventListener('DOMContentLoaded', function () {
    var buttons = document.querySelector(".first");
    console.log(buttons);

    var firstChildButton = buttons.firstElementChild;
    console.log(firstChildButton);

    var thirdChildButton = buttons.children[2];
    console.log(thirdChildButton);



});