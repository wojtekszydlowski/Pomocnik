/**
 STYLE
 Obiekt style przechowuje wszystkie wartości jako stringi (napisy). Tak samo będą one nam zwracane  i tak powinniśmy je nastawiać.

 Aktualną wartość stylu możemy wczytać:
 element.style.backgroundColor;

 Albo nastawić nową wartość:
 element.style.backgroundColor = "blue";

 ---

 CLASSLIST
 Metoda classList elementu zwraca listę wszystkich klas tego elementu.  Możemy łatwo z nią pracować dzięki następującym metodom:

 el.classList.add(className) – dodaje podaną klasę,
 el.classList.remove(className) – usuwa podaną klasę,
 el.classList.toggle(className) – przełącza  podaną klasę (czyli usuwa jeżeli jest, jeżeli jej nie ma, to dodaje).

 Przykład: Mamy taki element:
 <div id="myDiv" class="class1 class2"></div>
 var myDiv = document.getElementById("myDiv");

 Możemy łatwo wczytać jego wszystkie klasy:
 console.log( myDiv.classList );    // ["class1", "class2"] <- obiekt

 console.log( myDiv.className );    // class1 class2 <- string

 Możemy dodać nową klasę:
 myDiv.classList.add("nowaKlasa");
 console.log(myDiv.classList); //["class1", "class2", "nowaKlasa"]

 Możemy usunąć jedną z jego klas:
 myDiv.classList.remove("class1");
 console.log(myDiv.classList);   // ["class2", "nowaKlasa"]

 Możemy przełączać daną klasę:
 //dodaje ponieważ klasa nie istnieje
 myDiv.classList.toggle("toggleClass1");

 //usuwa ponieważ klasa istnieje
 myDiv.classList.toggle("nowaKlasa");

 console.log(myDiv.classList); //["class2", "toggleClass1"]

 ----

 DATASET - Dane powiązane z tagiem
 Możemy przetrzymać pewne dane powiązane z tagiem HTML, które mogą nam się później przydać, na przykład:
 - tagi do zdjęcia,
 - tooltip,
 - ID obiektu.
 Takie dane powinniśmy trzymać  w specjalnym atrybucie zaczynającym się od  data-
 W JavaScript mamy dostęp do specjalnego obiektu dataset należącego do elementu. Dzięki niemu możemy nastawiać lub wczytywać informacje z datasetu.

 Wszystkie dane poniższego elementu możemy z łatwością wczytać z datasetu:
 <div id="user" data-id="1234567890" data-user="johndoe" data-date-of-birth>John Doe</div>

 var myUser = document.querySelector("#user");

 console.log(myUser.dataset);        // {id: "1234567890", user: "johndoe", dateOfBirth: ""}
 console.log(myUser.dataset.id);     // 1234567890
 console.log(myUser.dataset.user);   // johndoe
 console.log(myUser.dataset.dateOfBirth); // [pusty element]


 Zmiana wartości w datasecie:
 console.log(myUser.dataset.id);   // 1234567890 - Stara wartość
 myUser.dataset.id = 4444;
 console.log(myUser.dataset.id);  // Nowa wartość


 Nowa wartość w datasecie:
 console.log(myUser.dataset.something); // ""
 myUser.dataset.something = "new value”;
 console.log(myUser.dataset.something); // "new value"


 ----

 ATRYBUTY ELEMENTÓW:
 Z poziomu JavaScript możemy edytować wszystkie atrybuty danego elementu.

 Przykład:
 <a href="www.google.com" id="glink">Hello Google!</a>
 var link = document.querySelector("#glink");

 el.hasAttribute(attrName) – sprawdza, czy element ma podany atrybut. W odpowiedzi dostajemy wartość boolean.
 np. link.hasAttribute("href"); // true

 el.getAttribute(attrName) – zwraca wartość podanego atrybutu.
 np. link.getAttribute('href'); // "www.google.com"

 el.removeAttribute(attrName) – usuwa podany atrybut.
 np. link.removeAttribute("href");
 link.hasAttribute("href"); // false
 link.getAttribute("href"); // null

 el.setAttribute(attrName, attrValue) – nastawia wartość podanego atrybutu.
 np. link.setAttribute("href", "www.something.com");
 link.hasAttribute("href"); // true
 link.getAttribute("href"); // "www.something.com"



 */

//PRZYKŁADY:

document.addEventListener("DOMContentLoaded", function() {
    /*

     Zadanie 1: Zmodyfikuj listę w następujący sposób:

     Dodaj atrybut data-direction nastawiony na wartość up każdemu elementowi li, który nie ma tego atrybutu.
     -Nastaw kolor tła co drugiego elementu listy na zielony.
     -Nastaw piątemu elementowi listy klasę big.
     -Nastaw co trzeciemu elementowi podkreślenie.
     */


    var liElements = document.querySelectorAll(".ex1 ul li:not([data-direction])");
    console.log(liElements);
    for (var i = 0; i < liElements.length; i++) {
        liElements[i].setAttribute("data-direction","up");
    }
    var listElems = document.querySelectorAll(".ex1 ul li");
    for (var i = 0; i < listElems.length; i++) {
        if (i%2!==0) {
            listElems[i].style.backgroundColor = "green";
        }
        if(i%5==0){
            listElems[i].classList.add("big");
        }
        if (i%3==0) {
            listElems[i].style.textDecoration = "line-through";
        }
    }


//Zadanie 2: W zadaniu (plik index.html) znajduje się prosty formularz z polem wyboru select. Ustaw każdemu elementowi option wartość opisu z atrybutu value. Dodaj każdemu elementowi atrybut data-year, użyj dataset, ale wynikowa wartość ma być o 20 większa niż w atrybucie value, czyli np. 2020 -> 2040.

    var options = document.querySelectorAll("option");
    //lub
    var options = document.querySelectorAll(".ex2 option");//bardziej dokładne
    for (i=0;i<options.length;i++){
        var yearValue = options[i].getAttribute("value");
        options[i].innerHTML = yearValue;
        var newYearValue =  parseInt(yearValue) + 20;
        options[i].dataset.year = newYearValue;
    }


    /**Zadanie 3:
     * Na stronie są trzy obrazki z ikonami najpopularniejszych przeglądarek internetowych. Niestety zarówno obrazki, jak i linki prowadzące do ich stron zawierają błędy. Napisz kod JavaScript, który wprowadzi następujące zmiany:

     Poprawi elementy tak, żeby do każdej przeglądarki było podpięte odpowiednie logo (obrazek jest nastawiany za pomocą background-image).
     Poprawi linki tak, żeby każdy miał poprawny opis i atrybut href.
     Poprawi szerokość elementu o klasie chrome (powinno być 100px).

     Podejrzyj w konsoli, jak wygląda kod CSS dopisany przez JavaScript. Zastanów się, dlaczego dopisywany jest w tym miejscu. Napisz odpowiedź na to pytanie w komentarzu do zadania.
      */


    var browserChromeImage = document.querySelector(".ex3 .chrome");
    //console.log(browserChromeImage);
    browserChromeImage.style.width = "100px";

    var browserChromeName = document.querySelector(".ex3 a");
    browserChromeName.innerText = "Chrome";
    //console.log(browserChromeName.innerText);

    var browserEdgeImage = document.querySelector(".ex3 .edge");
    //console.log(browserEdgeImage);
    browserEdgeImage.style.backgroundImage = "url('assets/img/edge.png')";

    var browserEdgeLink = document.querySelectorAll(".ex3 a:nth-child(1)");
    //var browserEdgeLink = document.querySelector(".ex3 a");
    console.log(browserEdgeLink);
    console.log("--");


});