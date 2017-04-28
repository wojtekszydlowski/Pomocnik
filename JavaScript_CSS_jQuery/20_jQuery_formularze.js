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


//--------------------


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

//---------------------


/**
 Na stronie znajduje się formularz do zamówienia pizzy. W formularzu znajduje się pole z checkboksami, w którym użytkownik może wybrać sobie dodatki. Cena każdego z dodatków jest trzymana w atrybucie data-price. Napisz takie eventy, żeby po zaznaczeniu checkoxa wyświetlała się poprawna kwota zamówienia oraz po wysłaniu formularza wyświetlił się alert z wyliczoną kwotą. Zwróć uwagę na dwa specjalne checkboksy:

 none – powinien odznaczyć wszystkie inne opcje,
 all – powinien zaznaczyć wszystkie inne opcje (poza none).

 */


$(document).ready(function e() {

    var checkboxes = $('.checkbox').find('input');

    checkboxes.eq(0).on("click", function () {
        checkboxes.prop( "checked", true );
        checkboxes.eq(-1).prop( "checked", false );
    });

    checkboxes.eq(-1).on("click", function () {
        checkboxes.prop('checked', false);
    });

    checkboxes.on("click", function () {
        var sumMoney = 0;
        checkboxes.each(function () {

            if ($(this).prop( "checked") == true ) {
                var getPrice = Number($(this).data("price"));//z pobranych wybieramy tylko liczby
                if (getPrice >0) {sumMoney += getPrice;} //pierwszy checkbox może mieć wartoć NaN, dlatego sumujemy tylko liczby


            }
            console.log("sumMoney:" + sumMoney);
            $('#price').text(sumMoney.toFixed(2) + " zł"); //toFixed(2) zaorkągla da dwóch miejcu po przecinku
        });
    });


});


//---------------------

/**
 Na stronie znajduje się select i trzy obrazki. Każdy z obrazków jest przypisany do jednego z wyborów w selekcie. Napisz kod javaScript w taki sposób, żeby widoczny był tylko ten obrazek, który został wybrany.

 KOD HTML:
 <div class="container">
 <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
 <div class='page-header'>
 <h1>Wybierz swój system:</h1>
 <img src="tasks_assets/windows.jpg">
 <img src="tasks_assets/apple.jpg">
 <img src="tasks_assets/ubuntu.png">
 </div>

 <div class='panel'>
 <div class='panel-body'>
 <form>
 <select class="form-control">
 <option>Windows</option>
 <option>Os X</option>
 <option>Ubuntu</option>
 </select>
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



$(document).ready(function e() {

    var divPicture = $('.page-header').find('img');
    divPicture.css('visibility', 'hidden');

    var optionSelected = $("option:selected", $('.form-control'));
    var indexSelected = optionSelected.index();
    $('.page-header').find('img').eq(indexSelected).css('visibility', 'visible');

    //To nic nie robi - pokazuje tylko inny sposób sprawdzenia, która opcja jest zaznaczona
    var whichSelect = $('.form-control').find('option');
    whichSelect.each(function () {
        if ($(this).is(':selected')) {var systemSelected = $(this).text(); console.log(systemSelected);}
    });

    $('.form-control').on("change", function () {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        var indexSelected = optionSelected.index();

        $('.page-header').find('img').css('visibility', 'hidden');
        $('.page-header').find('img').eq(indexSelected).css('visibility', 'visible');
    });


});


//-----------------------


/**
 Na stronie znajduje się formularz, który odsyła do strony http://api.coderslab.pl/showpost.php. Napisz walidację tego formularza w taki sposób, żeby wysyłany był tylko i wyłącznie wtedy, kiedy spełnione zostaną następujące warunki:

 Email zawiera w sobie @.
 Imię jest dłuższe niż pięć znaków.
 Nazwisko jest dłuższe niż pięć znaków.
 Hasło i hasło drugie są identyczne.
 Checkbox musi być zaznaczony.

 Warunek dla chętnych. Dodatkowe. Hasło ma mieć co najmniej pięć znaków (w tym co najmniej jedną liczbę i jedną literę).

 Zauważ, jak dane wyświetlane są na stronie docelowej (jak ich nazwy są skorelowane z kodem HTML). Spróbuj pozmieniać atrybuty name i zobacz, jak się zmieniają wysyłane dane (np. sprawdź, co się stanie, jak dwa inputy mają taką samą nazwę). Uwaga, jest to ważne miejsce współpracy frontendowców z backendowcami.

 KOD HTML:

 <div class="container">
 <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
 <div class='page-header'>
 <h1>Zarejestruj się</h1>
 </div>

 <div class='panel'>
 <div class='panel-body'>
 <form action="http://api.coderslab.pl/showpost.php" method="post"> <!-- http://api.coderslab.pl/showpost.php -->
 <div class='form-group'>
 <label>Email:</label>
 <input type="text" class='form-control' id='email' name="email">
 <label>Imie:</label>
 <input type="text" class='form-control' id='name' name="name">
 <label>Nazwisko:</label>
 <input type="text" class='form-control'  id='surname' name="surname">
 <label>Hasło:</label>
 <input type="password" class='form-control'  id='pass1' name="pass1">
 <label>Powtórz hasło:</label>
 <input type="password" class='form-control'  id='pass2' name="pass2">
 </div>
 <div class="checkbox">
 <label><input type="checkbox" id="agree"> Zgadazm się na warunki...</label>
 </div>
 <p>
 <button class='btn btn-primary'>Submit</button>
 </p>
 </form>
 </div>
 </div>
 </div>
 </div>
 */

function validateEmail (email){

    console.log(email);
}

function validateForm() {


    var pass1 = $('#pass1').val();
    var pass2 = $('#pass2').val();
    if (pass1 !== pass2) {return false;}


    var email = $('#email').val();
    if (email.indexOf('@') == -1) {
        // nie zawiera znaku @
        return false;
    }

    var name = $('#name').val();
    if (name.length < 6) {return false;}

    var surname = $('#surname').val();
    if (surname.length < 6) {return false;}

    var agree = $('#agree');
    if (agree.prop( "checked") == false){return false;}

    return true;
}

$(document).ready(function e() {

    var button = $('button');
    button.on("click", function (event) {
        var email = $('#email').val();
        var isFormValid = validateForm();
        if (isFormValid == false) {event.preventDefault();}
    });


});

//-----------------

/**
 Na stronie znajduje się tablica z wynikami w lokalnych mistrzostwach piłkarskich. Poniżej znajduje się formularz, który wypełniają wszyscy sędziowie po ukończonych rozgrywkach. Napisz kod JavaScript w taki sposób, żeby po wybraniu odpowiednich drużyn nastąpiła walidacja:

 Obie drużyny muszą być różne.
 Liczba goli powinna być nieujemna.

 Jeżeli formularz zostanie zweryfikowany poprawnie, odpowiednia informacja o wyniku spotkania powinna pojawić się w tablicy.


 KOD HTML:
 <div class="container">
 <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
 <table class="table table-bordered">
 <tr>
 <td colspan="3">Tablica wyników</td>
 </tr>
 <tr>
 <td>Drużyna 1</td>
 <td>Drużyna 2</td>
 <td>Wynik:</td>
 </tr>
 <tr>
 <td>Kometa Pionki</td>
 <td>Błyskawica Ostrołęka</td>
 <td>3 - 4</td>
 </tr>
 </table>
 </div>
 </div>

 <div class="container">
 <div class='col-xs-12 col-sm-6 col-sm-offset-3'>
 <div class='page-header'>
 <h1>Zarejstruj się</h1>
 </div>

 <div class='panel'>
 <div class='panel-body'>
 <form>
 <div class='form-group'>
 <label>Drużyna 1:</label>
 <input type="text" class='form-control' id='team1' name="email">
 <label>Ilość punktów drużyny 1:</label>
 <input type="text" class='form-control'  id='points1' name="surname">
 <label>Drużyna 2:</label>
 <input type="text" class='form-control' id='team2' name="name">
 <label>Ilość punktów drużyny 2:</label>
 <input type="text" class='form-control'  id='points2' name="surname">
 </div>
 <p>
 <button class='btn btn-primary'>Submit</button>
 </p>
 </form>
 </div>
 </div>
 </div>
 </div>
 */

function validation () {
    var team1 = $('#team1').val();
    var team2 = $('#team2').val();
    if (team1 == team2) {return false;}

    var points1 = Number($('#points1').val());
    var points2 = Number($('#points2').val());
    if (points1 < 0 || points2 < 0) {return false;}
    return true;
}

$(document).ready(function e() {

    var button = $('button');
    button.on("click", function (event) {
        var possibleToAdd = validation();
        if (possibleToAdd == true) {

            //Wersja z klonowaniem:
            var clonedTr = $('.table-bordered').find('tr').eq(-1).clone();
            var existingTr = $('.table-bordered').find('tr').eq(-1);
            var team1 = $('#team1').val();
            var team2 = $('#team2').val();
            var points1 = Number($('#points1').val());
            var points2 = Number($('#points2').val());

            clonedTr.find('td').eq(0).text(team1);
            clonedTr.find('td').eq(1).text(team2);
            var score = points1 + " - " + points2;
            clonedTr.find('td').eq(2).text(score);
            existingTr.after(clonedTr);

            //Wersja z utworzeniem samemu tr, td:
            // var team1 = $('#team1').val();
            // var team2 = $('#team2').val();
            // var points1 = Number($('#points1').val());
            // var points2 = Number($('#points2').val());
            // var addTr = "<tr><td>" + team1 + "</td><td>" + team2 + "</td><td>" + points1 + " - " + points2 + "</td></tr>";
            // var existingTr = $('.table-bordered'); // tu trzeba do rodzica się odnieść (<table>), aby wstawić tr
            // existingTr.append(addTr);


        }
        event.preventDefault();
    });

});
