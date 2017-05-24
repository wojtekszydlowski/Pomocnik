/**
# Eventy w DOM-ieEventy i funkcja callback
 Eventy - Są to wydarzenia odbywające się na naszej  stronie WWW. Dzięki językowi JavaScript jesteśmy w stanie przejąć kontrolę nad eventem i odpowiednio reagować. Eventy dzielimy wedle rodzaju interakcji np. użycie myszki czy klawiatury, edycja  formularza lub okna przeglądarki itp. W obiekcie event są zawarte  informacje dotyczące danej akcji.

 Callback - specjalna funkcja, którą podajemy do wywołania. Nie jest uruchamiana od razu, lecz po wystąpieniu jakiegoś zdarzenia. Każdy event w JavaScript jest tworzony za pomocą funkcji callback.

 Eventy dodajemy przez użycie metody  addEventListener(eventName, callback)  na obiekcie elementu. Zazwyczaj robimy to poprzez użycie
 anonimowych wyrażeń funkcyjnych (czyli poprzez definicje funkcji w miejscu w którym ją podajemy - funkcja nie ma nazwy). Dzięki temu mamy pewność że nasza funkcja  zostanie użyta tylko i wyłącznie w danym miejscu.


 #Dodawanie eventów do elementów:

 Kod HTML:
 <button id="counter">Click me!</button>

 Kod JavaScript:
 var button = document.querySelector("button");
 var clickCount = 0;
 button.addEventListener("click", function (event) {
  clickCount += 1;
  console.log("Click number", clickCount);
 });

 Drugi sposób:
 Eventy dodajemy przez użycie metody addEventListener(eventName, callback) na obiekcie elementu. Możemy jednak czasami przekazać normalnie
 stworzoną funkcję jako callback do eventu.

 Przykład (ten sam co wyżej tylko inną metodą):

 Kod HTML:
 <button id="counter">Click me!</button>

 Kod JavaScript
 var clickCount = 0;
 function clickCounter (event) {
 clickCount += 1;
 console.log('Click number', clickCount);
 }

 var button = document.querySelector("button");
 button.addEventListener("click", clickCounter); // - tutaj clickCounter wywołujemy bez nawiasów

 -----

 #Usuwanie eventów z elementów:
 -Możemy też usunąć event z elementu. robimy to za pomocą metody: removeEventListener(event, callback).
 -Nie da się usunąć eventów, które zostały dodane za pomocą funkcji anonimowych!

 Kod HTML:
 <button id="counter">Click me!</button>

 Kod JavaScript:
 var button = document.querySelector('button');
 var clickCount = 0;
 function clickCounter (event) {
  console.log('Click number', clickCount);
  clickCount += 1;
  if(clickCount >= 10) {
    event.target.removeEventListener('click',clickCounter);
    }
  }
 button.addEventListener('click', clickCounter);

 ------

 LISTA EVENTÓW:

 mouse:
 mousedown, mouseup, click, dblclick, mousemove, mouseover, mouseout

 key:
 keydown, keypress, keyup

 touch:
 touchstart, touchmove, touchend, touchcancel

 control:
 resize, scroll, focus, blur, change, submit

 no arguments:
 load, unload, DOMContentLoaded

 Pełna lista eventów:
 https://en.wikipedia.org/wiki/DOM_events

 -------

 DOMContentLoaded

 DOMContentLoaded jest specjalnym eventem, uruchamiającym się w momencie załadowania całej strony.

 document.addEventListener("DOMContentLoaded", function () {
  console.log("DOM fully loaded and parsed");
  });


 --------

 this w eventach

 -W każdym evencie mamy możliwość odwołania się do zmiennej this.
 -Jest to specjalna zmienna reprezentująca  element, na którym został wywołany event.
 -Jest ona szczególnie przydatna, jeżeli taki sam event nastawiamy na wiele elementów.

 Przykład:
 W jednym miejscu zakładamy  event na wszystkie guziki. Event ten zmieni kolor tylko tego guzika, w który klikamy, nie wpływa na inne.


 Kod HTML:
 <button class="btn">Click me!</button>
 <button class="btn">Click me!</button>
 <button class="btn">Click me!</button>

 Kod JavaScript:
 var buttons = document.querySelectorAll(".btn");
 for(var i = 0; i < buttons.length; i++) {
   buttons[i].addEventListener("click", function(event) {
   this.style.backgroundColor = "red";
  });
 }

 ----------


 Obiekt event:
 Event jest opisywany przez specjalny obiekt. Dzięki niemu możemy dowiedzieć się wielu przydatnych rzeczy na temat zdarzenia. Oto jego przykładowe właściwości:

 event.currentTarget – zwraca element, na którym wywołany został event,
 event.target – zwraca element, który spowodował wywołanie eventu,
 event.timeStamp – zwraca czas, w którym został wywołany event,
 event.type – zwraca typ eventu (jako string).

 Obiekt Event ma jeszcze kilka przydatnych metod:
 event.preventDefault() – anuluj oryginalną akcję,
 event.stopPropagation() – anuluj wszystkie eventy tego samego typu z elementów nadrzędnych,
 event.stopImmediatePropagation() – anuluj wszystkie eventy tego samego typu przypięte do tego elementu oraz wszystkich elementów nadrzędnych.


 ----------

 Propagacja eventów:
 W DOM mamy do czynienia z tak zwaną  propagacją eventów. Polega ona na przekazywaniu eventu w górę drzewa DOM. Nazywa się to event bubbling.

 Mamy przykład:
 <body>
  <ul>
   <li><a href="#">link do bloga</a></li>
  </ul>
 </body>

 Kliknięcie na elemencie a oznacza kliknięcie na li, ul oraz body. Dzieje się to na wskutek propagacji zdarzeń. Mogą być dwa sposoby rozpropagowania kliknięcia elementu a:
 przechwytywanie zdarzenia – body -> ul -> li -> a,
 bąbelkowanie zdarzenia (czyli przenoszenie się do góry hierarchii dokumentu) – a -> li -> ul -> body (pęknięcie wewnętrznego bąbelka powoduje pęknięcie nadrzędnego).

 Specyfikacja DOM mówi, że powinny nastąpić trzy kolejne fazy: przechwytywanie zdarzenia, element docelowy, bąbelkowanie.

 Aby przerwać tą wędrówkę do góry (bąbelkowanie) oraz kolejne nasłuchy można skorzystać z dwóch sposobów:
 -z metody e.stopPropagation() - można zatrzymać propoagację na wybranym etapie
 -return false - zatrzymuje propagację od razu w całym dokumencie DOM do góry hierarchii

 Przykład: Nie zastosowano zatrzymania propagacji:

 Kod HTML
 <div id="foo">
 <button id="bar">Click me!</button>
 </div>

 Kod JavaScript
 document.querySelector('#foo').addEventListener
 ('click', function (e) {
    console.log('Target:', e.target.id);
    console.log('CurrentTarget:', e.currentTarget.id);
  });
 // "Target:" "bar"
 // "CurrentTarget" "foo"

 ------------


 MouseEvent:
 Jest to specjalny typ eventu tworzony podczas zdarzeń związanych z myszką. Rozszerza on podstawowy event o następujące atrybuty:
 -event.button – zwraca przycisk myszki, który został naciśnięty,
 -event.clientX – zwraca koordynat X (horyzontalny) myszki, relatywnie do górnego, lewego rogu strony,
 -event.clientY – zwraca koordynat Y (wertykalny) myszki relatywnie do górnego, lewego rogu strony,
 -event.screenX – zwraca koordynat X (horyzontalny) myszki, relatywnie do górnego, lewego rogu okna,
 -event.screenY – zwraca koordynat Y (wertykalny) myszki, relatywnie do górnego, lewego rogu okna.


 KeyboardEvent:
 Jest to specjalny typ eventu tworzony podczas zdarzeń związanych z klawiaturą. Rozszerza on podstawowy event o następujące atrybuty:
 -event.altKey – zwraca true, jeżeli alt był naciśnięty,
 -event.ctrlKey – zwraca true, jeżeli ctrl był naciśnięty
 -event.shiftKey – zwraca true, jeżeli shift był naciśnięty.
 -event.charCode – zwraca znak opisujący klawisz, który wywołał event,
 -event.key – zwraca wartość klawisza, który wywołał event,
 -event.keyCode – zwraca wartość Unicode klawisza, który wywołał event,

 Pełna lista typów eventów:
 http://www.w3schools.com/jsref/dom_obj_event.asp


 */

//Przykład - podpinamy dwie funkcje do jednego przycisku - wywoła dwie różne funkcje po kliknięciu w jeden button

//Kod html:
//<button id="counter">Click me!</button>

var button = document.querySelector("button");
var clickCount = 0;
var randomWords = ['Some', 'Random', 'Words'];

function clickCounter (event) {
    clickCount += 1;
    console.log('Click number', clickCount);
}

function randomWord (event) {
    var myWord = randomWords[Math.floor(Math.random()* randomWords.length)];
    console.log(myWord);
}

button.addEventListener('click', clickCounter);//najpierw wykonuje ten event - pierwszy w kolejności
button.addEventListener('click', randomWord);


//------------


//Przykład - mamy 3 przyciski tej samej klasy i ma zmienić kolor tylko ten w który kliknęliśmy

//Kod HTML:
//<button class="btn">Click me!</button>
//<button class="btn">Click me!</button>
//<button class="btn">Click me!</button>

var buttons = document.querySelectorAll(".btn");


for(var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("mouseover", function(event) {
        this.style.backgroundColor = "green";
    });
    buttons[i].addEventListener("mouseout", function(event) {
        if ( this.style.backgroundColor != "red" ) {
            this.style.backgroundColor = "white";
        }
    });

    buttons[i].addEventListener("click", function(event) {
        this.style.backgroundColor = "red";
    });

}



//---------------


//Przykład z Propagacja eventów

//HTML:
/*
<body>
<div>teskt0
<button class="btn"> Kliknij mnie 0</button>
<div>teskt1
<button class="btn"> Kliknij mnie 1</button>
<div>teskt2
<button class="btn"> Kliknij mnie 2</button>
</div>
</div>
</div>
</body>
*/

function clickCounter(event) {
    counter += 1;
    console.log(counter);
}
function clickAlert(event) {
    counter += 1;
    alert(counter);
}

function addClickEventChangeColorRed(elements)
{
    for (var i = 0; i < elements.length; i++)
    {
        elements[i].addEventListener('click', function (event) {
            this.style.backgroundColor = 'red';
            event.stopPropagation(); // tu zapobiega dziedziczeniu w zwyż - gdyby tego nie było kliknięcie np. w dowolny przycisk robiłoby czerwone tło dla tego przycisku, divów i body
        });

    }
}

var buttons = document.querySelectorAll('.btn');
var divs = document.querySelectorAll('div');

addClickEventChangeColorRed(buttons);
addClickEventChangeColorRed(divs);



var body = document.querySelector('body');
body.addEventListener('click', function (event) {
    this.style.backgroundColor = 'red';
});


//-------------------

//ZADANIA Z CODERSLAB:

/**
 Na stronie znajdują się trzy guziki. Napisz jeden event dla wszystkich guzików, który ma być podpięty do elementu rodzica o id bubblingButtons, który spowoduje, że po kliknięciu licznik znajdujący się w atrybucie data-counter zwiększy wartość o jeden. Pamiętaj, żeby wszystko pisać w evencie DOMContentLoaded.

 KOD HTML:
 <div id="bubblingButtons">
 <button data-counter="0">KLIK 1</button>
 <button data-counter="0">KLIK 2</button>
 <button data-counter="0">KLIK 3</button>
 </div>
 */

document.addEventListener('DOMContentLoaded', function () {
    var bubblingButtons = document.getElementById('bubblingButtons');

    bubblingButtons.addEventListener("click", function(e) {

        //e.target.style.backgroundColor = "red"; // zmieni przycisk, który wywołał kliknięcie na czerwony
        e.target.dataset.counter = Number(e.target.dataset.counter) + 1; //zamienia na liczbę i dopiero dodaje

        console.log (e.target); //wypisze w kosoli w który przycisk kliknęliśmy
    });
});



/**

 Na stronie znajduje się guzik. Podepnij do niego event, który na kliknięcie spowoduje, że w konsoli wyświetli się napis "Hura! Działa!". Pamiętaj, żeby wszystko pisać w evencie DOMContentLoaded.

 KOD HTML:
 <button id="mainBtn">Click me!</button>
 */

document.addEventListener('DOMContentLoaded', function () {
    var mainBtn = document.querySelector("#mainBtn"); //wyszukuje button i id=mainBtn

    mainBtn.addEventListener('click', function (e) {
        console.log('Hura! Działa!');
    });

});



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


document.addEventListener('DOMContentLoaded', function () {
    var buttons = document.querySelectorAll("button");
    var counter = document.querySelector(".counter");
    console.log(counter.innerText);

    for (var i=0; i<buttons.length; i++) {

        buttons[i].addEventListener('click', function (e) {

            var currentValue = Number(counter.innerText);
            var newValue=currentValue+1;
            counter.innerText = newValue;

        });
    }

});

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


document.addEventListener('DOMContentLoaded', function () {

    var button1 = document.querySelector("#button1");
    var button2 = document.querySelector("#button2");
    var button3 = document.querySelector("#button3");

    button1.addEventListener('click', function () {
        var currentValue = Number(document.querySelectorAll(".counter")[0].innerText);
        var newValue=currentValue+1;
        document.querySelectorAll(".counter")[0].innerText = newValue;
    });

    button2.addEventListener('click', function () {
        var currentValue = Number(document.querySelectorAll(".counter")[1].innerText);
        var newValue=currentValue+1;
        document.querySelectorAll(".counter")[1].innerText = newValue;
    });

    button3.addEventListener('click', function () {
        var currentValue = Number(document.querySelectorAll(".counter")[2].innerText);
        var newValue=currentValue+1;
        document.querySelectorAll(".counter")[2].innerText = newValue;
    });

});




/**
 Na stronie znajdują się trzy elementy div, dla których napisz wspólny event zmieniający kolor tła tylko w klikniętym divie. Użyj do tego słowa kluczowego this. Pamiętaj, żeby wszystko pisać w evencie DOMContentLoaded.

 Hint: Żeby uzyskać losowy kolor użyj poniższego kodu:

 var randomColor = "#" + Math.floor(Math.random()*16777215).toString(16);

 KOD HTML:
 <div class="box" id="box1">Div 1</div>
 <div class="box" id="box2">Div 2</div>
 <div class="box" id="box3">Div 3</div>
 */


document.addEventListener('DOMContentLoaded', function () {
    var div = document.querySelectorAll(".box");

    for (var i=0; i<div.length; i++) {
        div[i].addEventListener('click', function (e) {

            var randomColor = "#" + Math.floor(Math.random() * 16777215).toString(16);
            this.style.backgroundColor = randomColor;

        });
    }
});


/**
 Na stronie znajduje się jeden element div. Napisz dla niego event, który będzie wypisywał położenie kursora myszy w chwili, gdy znajduje się nad tym elementem. Wyszukaj zarówno położenie kursora globalne (czyli odległość od górnego lewego rogu okna), jak i lokalne (czyli odległość od lewego górnego rogu elementu). Pamiętaj, żeby wszystko pisać w evencie DOMContentLoaded.

 KOD HTML:
 <div class="box big" id="box"></div>

 Polożenie myszki:
 Globalne: X: <span id="globalX"></span>
 Globalne: Y: <span id="globalY"></span>
 Lokalne: X: <span id="localX"></span>
 Lokalne: Y: <span id="localY"></span>
 */

document.addEventListener('DOMContentLoaded', function () {

    var div = document.querySelector("#box");
    var globalX = document.querySelector("#globalX");
    var globalY = document.querySelector("#globalY");
    var localX = document.querySelector("#localX");
    var localY = document.querySelector("#localY")
    div.addEventListener('mousemove', function (e) {
        //console.log(e);
        var currentglobalX = e.screenX;
        var currentglobalY = e.screenY;
        var currentlocalX=e.x;
        var currentlocalY=e.y;
        globalX.innerText = currentglobalX;
        globalY.innerText = currentglobalY;
        localX.innerText = currentlocalX;
        localY.innerText = currentlocalY;



    });

});