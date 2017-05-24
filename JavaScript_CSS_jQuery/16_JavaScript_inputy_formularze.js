/**
# Elementy typu form

 Formularze mają kilka własnych atrybutów, możemy je przypisać tylko do nich. Są to:
 -form.action – adres URL, do którego prowadzi formularz,
 -form.method – metoda, którą wysyłany jest formularz,
 -form.elements – kolekcja elementów należących do tego formularza (w kolejności wpisanej w kodzie HTML).

 Formularze mają też specjalne eventy:
 -submit – jest wywoływany przed wysłaniem formularza. Wysyłanie możemy zablokować przez preventDefault() albo zwrócenie false  z tego eventu,
 -reset – wywoływane po zresetowaniu formularza (rzadko używane).

 ----

# Input.value
 Elementy typu input mają kilka atrybutów specjalnych. Jeden z nich jest następujący:
 input.value – zwraca wartość, na jaką  nastawiony jest input. Może służyć też do nastawienia wartości.

 Kod HTML
 <input id="name">

 Kod JavaScript:
 var input = document.querySelector('#name');
 input.value //zwróci treść wpisaną przez użytkownika
 input.value = "Adam" //Nastawi wartość Inputa na napis Adam

 ----

# Elementy typu input:
 -input.type – inputy trzymają swój typ.  Można go też łatwo zmienić na inny.
 -input.disabled – zwraca wartość boolenowską,  która oznacza, czy element jest włączony czy nie. Możemy ją zmieniać.
 -input.checked (tylko checkboxy) – zwraca wartość boolenowską, która oznacza, czy element jest zaznaczony czy nie.

 Elementy typu input mają kilka specjalnych eventów, są to:
 -blur – wywoływany, gdy użytkownik opuści pole,
 -focus – wywoływany, gdy użytkownik zaznaczy pole,
 -change – wywoływany, gdy zmieni się wartość pola,
 -keydown, keyup, keypress – eventy związane z pisaniem na klawiaturze.


 */

//----------------------

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

KOD HTML:

<div class="container">
    <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
    <div class='page-header'>
    <h1>Order now</h1>
</div>

<div class='panel'>
    <div class='panel-body'>
    <form>
    <div class='form-group'>
    <label>Credit card number:</label>
<div class='input-group'>
    <input type="text" class='form-control' id='card'>
    <div class='input-group-addon' id='type'></div>
    </div>
    </div>
    <div class="form-group">
    <label>Name on card:</label>
<input type="text" class='form-control'>
    </div>
    <div class='clearfix'>
    <div class="form-group form-group-mini">
    <label>Expiry date:</label>
<input type='text' class='form-control'>
    </div>
    <div class="form-group form-group-mini">
    <label>CVV:</label>
<input type='text' class='form-control'>
    </div>
    </div>
    <br>
    <p>
    <button class='btn btn-primary'>Submit</button>
    </p>
    </form>
    </div>
    </div>
    </div>
    </div>

 */
function isValidNumber (text) {
    var validNumber = true;
    for (var i=0; i<text.length;i++) {
        var number = Number (text[i]);
        if (!(number>=0)) {
            validNumber = false;
            break;

        }
    }
    return validNumber;
}

function changeBackgroundIfNumberIsValid(element, text) {

}

document.addEventListener('DOMContentLoaded', function () {



    //pole w którym wpisujemy cyferki - id card
    var card = document.getElementById("card");
    //card.addEventListener("keypress", function(e) { - po naciśnięciu klawisza
    //console.log(e); - do sprawdzania - pokazuje co wciskaliśmy
    //if (e.key == '4') {console.log ('visa card');} - to wypisałoby w konsoli visa card jeśli wpiszemy kiedyś 4
    //card.addEventListener("keyup", function(e) {
    card.addEventListener("keyup", function(e) {
        cardNumbers = this.value; // to jest string - teraz trzeba będzie sprawdzić czy pierwszy znak w ciągu to 4 (visa) czy 5 (mastercard)
        firstDigit = cardNumbers[0];
        var cardType = "";
        var numberIsValid = isValidNumber(this.value);
        if (firstDigit == "4") {
            cardType = "VC";
            if (numberIsValid && cardNumbers.length > 12 && cardNumbers.length<17) {
                this.style.backgroundColor = "green";
            }
            else
            {
                this.style.backgroundColor = "white";
            }
        } else if (firstDigit == "5") {
            cardType = "MC";
            if (numberIsValid && cardNumbers.length == 16) {
                this.style.backgroundColor = "green";
            }
            else
            {
                this.style.backgroundColor = "white";
            }
        } else if (firstDigit == "3" && (cardNumbers[1] == "4" || cardNumbers[1] == "7")) {
            cardType = "AE";
            if (numberIsValid && cardNumbers.length == 15) {
                this.style.backgroundColor = "green";
            }
            else
            {
                this.style.backgroundColor = "white";
            }
        }
        var type = document.getElementById("type");
        type.innerText = cardType;

        if (isValidNumber(this.value)) {
            console.log ("poprawny numer");
        }
        else
        {
            console.log ("błędny numer");
        }
    });
});


//TO SAMO ZADANIE ROBIONE NA ZAJĘCIACH:

function isValidNumber(text){
    var validNumber = true;
    for (var i=0; i < text.length; i++){
        var number = Number(text[i]);
        console.log(number);
        if (!(number >= 0)){
            validNumber = false;
            break;
        }
    }
    return validNumber;
}
function changeColorIfNumberIsValid(dataObject, min, max ){
    if(dataObject['numberIsValid'] &&
        (dataObject['cardNumbers'].length >= min
        && dataObject['cardNumbers'].length <= max)){
        dataObject['element'].style.color = 'green';
    }
    else
    {
        dataObject['element'].style.color = 'black';
    }
}
document.addEventListener('DOMContentLoaded', function(){

    var card = document.getElementById('card');

    card.addEventListener('keyup', function(e){
        var cardNumbers = this.value;
        var firstDigit = cardNumbers[0];
        var cardType = '';
        var numberIsValid = isValidNumber(this.value);
        var dataObject = {'numberIsValid':numberIsValid,
            'cardNumbers':cardNumbers,
            'element':this};
        if(firstDigit == '4'){
            cardType = 'VC';
            changeColorIfNumberIsValid(dataObject, 13, 16);
        }else if(firstDigit == '5'){
            cardType = 'MC';
            changeColorIfNumberIsValid(dataObject, 16, 16);
        }else if(firstDigit == '3' &&
            (cardNumbers[1] == '4' ||
            cardNumbers[1] == '7')){
            cardType = 'AE';
            changeColorIfNumberIsValid(dataObject, 15, 15);
        }
        var type = document.getElementById('type');
        type.innerText = cardType;

    });
});


