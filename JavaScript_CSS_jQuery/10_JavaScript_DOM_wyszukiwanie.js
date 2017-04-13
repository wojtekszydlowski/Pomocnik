/**
 Do wyszukiwania pojedynczego elementu na stronie mamy następujące metody:

 document.querySelector("selector") –  wyszukuje pierwszy element odpowiadający  zapytaniu CSS,

 document.getElementById("id") – wyszukuje element z danym ID.

 Metody te zwracają pojedynczy element lub null, jeśli żaden z elementów  nie spełnia wymagań.

----

 Do wyszukiwania wielu elementów na stronie mamy następujące metody:

 document.querySelectorAll("selector") - wyszukuje wszystkie elementy odpowiadające zapytaniu CSS,

 document.getElementsByTagName("tag") – wyszukuje po podanym tagu,

 el.getElementsByClassName("className") – wyszukuje po nazwie klasy.

 Metody te zawsze zwracają tablicę elementów.  Jeśli żaden element nie spełnia wymagań  – tablica jest pusta.

----

 Jak łatwo zapamiętać kiedy użyć selektora CSS a  kiedy nie?

 document.querySelectorAll("selector") - Jeśli metoda zaczyna się od query jako argument przyjmuje ona zawsze selektor CSS

 document.getElementsByTagName("tag") - Jeśli metoda zaczyna się od get jako argument przyjmuje ona string będący np. nazwą klasy, id
 lub tagu html

----

 Metod tych możemy używać zarówno w obiekcie document, jak i w poszczególnych elementach (wtedy szukamy tylko wewnątrz tego elementu).

 var myButton = document.querySelector("div .btn");
 var allParagraphs = document.querySelectorAll("p");
 var barTable = document.getElementsByClassName("bar");
 var foo = document.getElementById("glink");
 var fooHeader = foo.querySelector("h1");

 */



/**
Zadanie 1:

Wyszukaj na stronie i zapisz do odpowiednio nazwanej zmiennej tag article o klasie first.
    W kolejnym etapie:

    wypisz w konsoli, ile elementów h1 znajduje się w tym tagu.
    wyszukaj w nim wszystkie elementy o klasie oferts, przeiteruj je i wypisz je w konsoli,
    wyszukaj w nim wszystkie elementy div, przeiteruj je i wypisz je w konsoli.

    Pamiętaj, żeby za każdym razem sprawdzić, czy wczytałeś odpowiednie elementy. Używaj funkcji, które wyszukują wiele elementów. Za każdym razem wypisz w konsoli, ile jest znalezionych przez Ciebie elementów.
*/




document.addEventListener("DOMContentLoaded", function(){ //funkcja zostanie wykonana dopiero wtedy, gdy cały dokument zostanie załadowany

    var articleFirst = document.querySelector("article.first"); // szukamy artykułu w klasie first
    //Ważne:  # - oznacza id, . - oznacza klasę, bez niczego przed - tag html
    console.log(articleFirst);
    var h1Elements = articleFirst.querySelectorAll("h1");
    console.log(h1Elements); //pusta tablica - nie znalazł żadnego h1
    var h2Elements = articleFirst.querySelectorAll("h2");
    console.log(h2Elements); //pokaże tablicę z elementami h2
    console.log(h2Elements.length); //pokaże ile elementów H2 znaleziono

    var ofertsElement = articleFirst.querySelectorAll(".oferts"); //szukamy po klasie
    var ofertsElement = articleFirst.getElementsByClassName("oferts"); //drugi sposób
    console.log(ofertsElement);

    console.log("Wszystkie elementy o klasie oferts:")
    for (var i=0; i<ofertsElement.length;i++) {
        console.log(ofertsElement[i]);
    }

    console.log("Wszystkie elementy div:")
    var divElement = articleFirst.getElementsByTagName("div");
    for (var i=0; i<divElement.length;i++) {
        console.log(divElement[i]);
    }
    console.log("Znaleziono elementów: " + divElement.length);


    /**
     Zadanie 2: Wyszukaj na stronie i zapisz do zmiennej element o id exercise2, który znajduje się w menu. Skorzystaj z selektora CSS. Nie odwołuj się bezpośredniego do klasy lub id jakiegokolwiek elementu. Użyj selektorów potomków, dzieci, n-tych dzieci itp.
     */

    console.log("-------------------------");
    console.log("Zadanie 2:");

    var exercise2 = document.querySelector("nav ul li:nth-child(5) a");
//var exercise2 = document.querySelector("#exercise2"); - to byłby inny sposób - odwołanie się bezpośrednio do id
// w [] szuka się atrybutów
    console.log(exercise2);


    /**
     Zadanie 3: Wyszukaj na stronie następujące elementy i zapisz je do odpowiednio nazwanych zmiennych:

     Element o id home (na dwa sposoby).
     Pierwszy element li nieposiadający atrybutu data-direction.
     Pierwszy element o klasie block.

     Pamiętaj, żeby za każdym razem sprawdzić, czy wczytałeś odpowiedni element. Używaj funkcji wyszukujących tylko jeden element.
     */

    console.log("-------------------------");
    console.log("Zadanie 3:");

//Element o id home (na dwa sposoby).
    var idHome = document.getElementById("home");
    console.log(idHome);
    var idHome = document.querySelector("header");
//lub
    var idHome = document.querySelector("#home");
    console.log(idHome);

//Pierwszy element li nieposiadający atrybutu data-direction.
//var liElement = document.querySelector("nav ul li:nth-child(3)");
    var liElement = document.querySelector("nav ul li:not([data-direction])");
//lub
    var liElement = document.querySelector("li:not([data-direction])");
    console.log(liElement);

//Pierwszy element o klasie block.
    var blockClass = document.querySelector(".block");
    console.log(blockClass);


//Przykłady:
    console.log("-------------------------");
    console.log("Przykłady:");

    var liElement = document.querySelector("li:not([data-direction])");
    console.log(liElement.innerHTML);
    console.log(liElement.classList);//nie zwróci nam klasy, bo dopiero znacznik <a> ma klasę

    /**
     * Zadanie 4

     Wyszukaj na stronie następujące elementy i zapisz je do odpowiednio nazwanych zmiennych:

     Wszystkie elementy li znajdujące się w tagu nav.
     Wszystkie paragrafy należące do wszystkich elementów div.
     Wszystkie divy znajdujące się w tagu article.

     */

    console.log("-------------------------");
    console.log("Zadanie 4:");

    var allLiElements = document.querySelectorAll("nav ul li");
    console.log("allLiElements:");
    console.log(allLiElements);
    console.log("Znaleziono allLiElements: " + allLiElements.length);

    var allParagraphs = document.querySelectorAll("div p");
    console.log("allParagraphs:");
    console.log(allParagraphs);
    console.log("Znaleziono allParagraphs: " + allParagraphs.length);

    var allDivTagArticle = document.querySelectorAll("article div");
    console.log("allDivTagArticle:");
    console.log(allDivTagArticle);
    console.log("Znaleziono allDivTagArticle: " + allDivTagArticle.length);

    /**
     Zadanie dodatkowe:
     Znajdź wszystkie elementy li, które są w tagu nav. Następnie nadaj każdemu elementowi li atrybut data-direction = "top", ale tylko dla tych elementów, które nie mają ustawionego tego atrybutu.
     */

    //Znajduje tylko te elementy li, które nie mają artybutu data-direction
    var allLiElementsNoDataDirection = document.querySelectorAll("nav ul li:not([data-direction])");
    for (var i=0; i<allLiElementsNoDataDirection.length;i++){
        //el.hasAttribute(attrName)
        console.log(allLiElementsNoDataDirection[i].hasAttribute("data-direction"));
        console.log(allLiElementsNoDataDirection[i].setAttribute("data-direction","top"));
        //setAttribute(attrName, attrValue)
    }

});  // Koniec document.addEventListener("DOMContentLoaded", function()