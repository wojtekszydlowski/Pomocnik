/**
# Tworzenie elementów:
 -Elementy możemy tworzyć przez użycie metody  createElement() na obiekcie document.
 -Do metody tej przekazujemy napis oznaczający, jakiego typu element chcemy stworzyć.
 -Nowo utworzony element najlepiej zapamiętać  do zmiennej, żeby potem nim manipulować.

 var newDiv = document.createElement("div");

 ----

# Klonowanie elementów

 Jeżeli mamy już element, na którym chcemy się wzorować (np. ma nastawione odpowiednie klasy, atrybuty), to łatwo możemy go sklonować dzięki metodzie cloneNode(deep).
 Wartość deep przyjmująca true albo false oznacza, czy klonowanie ma być głębokie czy nie.
 Głębokie klonowanie kopiuje i zwraca element wraz z całym poddrzewem czyli wszystkimi potomkami.

 var toClone = document.querySelector('#foo');
 var newDiv = toClone.cloneNode(true);

 ----

# Dodanie stworzonego elementu do DOM

 Stworzenie elementu nie oznacza, że jest dodany do DOM. Możemy go przypisać do zmiennej, pracować na nim, ale nie będzie on dostępny dla użytkownika naszej strony.
 Element stanie się widoczny na stronie dopiero w chwili, w której zostanie on do niej podpięty.

 W celu poprawnego dodania elementu do DOM możemy użyć następujących metod:
 -el.appendChild(nowyElement) – dodaj element jako ostatnie dziecko danego węzła,
 -el.insertBefore(nowyElement, dziecko) – dodaj element przed jednym z podanych dzieci,
 -el.replaceChild(nowyElement, dziecko) – zamień podane dziecko.

 <div id="foo"></div>

 var fooElement = document.querySelector('#foo');

 var newBar = document.createElement("div");
 fooElement.appendChild(newBar);

 var newBuz = document.createElement("h1");
 fooElement.insertBefore(newBuz, newBar);

 var newBuz = document.createElement("p");
 fooElement.replaceChild(newBuz, newBar);

 ----

# Usuwanie elementów z DOM
 W celu usunięcia elementu już istniejącego na stronie musimy użyć metody na jego rodzicu:
 el.removeChild(element)

 var toDelete = document.querySelector('#bar');
 toDelete.parentNode.removeChild(toDelete);

 */

var foo = document.querySelector('#foo');
var newDiv = document.createElement('div');
foo.appendChild(newDiv);

var newH1 = document.createElement('h1');
foo.insertBefore(newH1, newDiv); //wstawia przed

var newP = document.createElement('p');
foo.replaceChild(newP, newH1); //zamienia

newP.parentNode.removeChild(newP); //usuwa



//-------------------

//PRZYKŁADY:

/**
 Na stronie znajduje się tabela z informacjami na temat zamówień (z dwoma już wprowadzonymi zamówieniami). Poniżej znajduje się formularz do wypełnienia nowego zamówienia. Napisz event, który pobierze informacje z inputów (el.value) i wprowadzi nowy wpis do tablicy.

 KOD HTML:
 <table id="orders">
  <tr>
   <td>
    Numer zamówienia
   </td>
   <td >
    Przedmiot
   </td>
   <td>
   Ilość
   </td>
  </tr>
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
 </tr>
 <tr>
 <td >
 1
 </td>
 <td>
 Klawiatura
 </td>
 <td>
 2
 </td>
 </tr>
 </table>

 <label>
 Numer zamówienia:
 <input type="text" id="orderId">
 </label>
 <label>
 Przedmiot:
 <input type="text" id="item">
 </label>
 <label>
 Ilość:
 <input type="text" id="quantity">
 </label>

 <a class="button" id="addBtn">Dodaj przedmiot</a>

 */


document.addEventListener('DOMContentLoaded', function () {

    var addBtn = document.querySelector('#addBtn'); //szukamy przycisku, bo on ma nam dodawać elementy - po jego kliknięciu
    addBtn.addEventListener("click", function(e) {
        var orderId = document.querySelector("#orderId") ; //pobieramy inputy
        var item = document.querySelector("#item") ;
        var quantity = document.querySelector("#quantity") ;

        var orderArray = [orderId, item, quantity]; //stworzyłem tablicę ze wszystkimi inputami

        //var orderArray = document.querySelectorAll("input"); // to szybszy sposób stworzenia tablicy - nie trzeba ręcznie inputów do tablicy dodawać

        //Metoda z klonowaniem - pierwszy sposób
        var clone = document.querySelector("tr").cloneNode(true); //znajduję tr i robię z niego clona zachowując głębokość klonowania - klonuję też jego dzieci czyli td
        //można też inaczej - stworzyć tr: var tr = document.createElement ("tr"); i później 3 razy stworzyć td itd.

        var cloneChildern = clone.children;

        //przypisujemy wartości w pętli
        for (var i=0; i<cloneChildern.length; i++) {
            cloneChildern[i].innerText = orderArray[i].value; //innerText - aby dostać się do tekstu w td (dzieci tr) - td mają innerTEXT a inputy value
            console.log(cloneChildern[i].value);

        }

        //potrzebujemy teraz dodać to do tej tabeli o id=orders
        var orders = document.querySelector("#orders");//znajduję tabelę orders
        orders.appendChild(clone); //dopisuję do tablicy przypisane wartość z powyższej pętli


        //Drugi sposób:

        // var tr = document.createElement("tr");
        // var td1 = document.createElement("td");
        // var td2 = document.createElement("td");
        // var td3 = document.createElement("td");
        //
        //  td1.innerText = orderId.value;
        //  td2.innerText = item.value;
        //  td3.innerText = quantity.value;
        //
        //  tr.appendChild(td1);
        //  tr.appendChild(td2);
        //  tr.appendChild(td3);
        //
        //  orders.appendChild(tr);

    });

});