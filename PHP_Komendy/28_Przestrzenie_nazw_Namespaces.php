<?php
/*
Czym są przestrzenie nazw?
-Przestrzenie nazw pozwalają na tworzenie bardziej przejrzystego i głównie zhermetyzowanego kodu.
-Pomagają przy pracy z dużymi projektami gdzie mogą wystąpić dwie lub więcej klas o tej samej nazwie.

Definiowanie przestrzeni nazw:
-Aby zdefiniować przestrzeń nazw należy umieścić jako pierwsza instrukcja pliku nazwę przestrzeni poprzedzoną słowem kluczowym namespace.
-Przestrzenie nazw powinny mieć swoje nazwy zgodne ze struktura katalogów w jakich znajdują się pliki z klasami, nie jest to wymagane ale przynosi dużą korzyść o czym dowiecie się na kolejnych slajdach.
Przykłady:
namespace Foo;
namespace Foo\Bar;
namespace Foo\Bar\Baz;


plik class.userAccount.php:

namespace User\Account;
class Register {
  public function getFormData ()
  {
    return true;
  }
}

$uReg = new Register(); // Fatal error: Class 'Register' not found!
$uRegAccount = new User\Account\Register(); //Teraz nasza klasa to User\Account\Register a nie Register

--

plik class.userForum.php:

namespace User\Forum;
class Register {
  public function getFormData ()
  {
   return true;
  }
}

$uRegForum = new User\Forum\Register();

--

Spróbujmy utworzyć obiekty naszych klas:
include('class.userAccount.php');
include('class.userForum.php');

$uRegAccount = new User\Account\Register();
$uRegForum = new User\Forum\Register();

Utworzyliśmy obiekty klas o takiej samej nazwie dzięki przestrzeniom nazw. Gdybyśmy ich nie użyli otrzymalibyśmy błąd Fatal error: Cannot redeclare class Register

--

Może się zdarzyć iż nasza przestrzeń nazw będzie bardzo długa co może spowodować nie czytelność kodu.

plik class.userAccountDhl.php
namespace User\Account\Shop\Shipping\Dhl;
class SendParcel {
  public function prepareParcel()
  {
   return true;
  }
}

$dhl = new User\Account\Shop\Shipping\Dhl\SendParcel(); //Nasz kod staje się nie czytelny a co w wypadku jeśli będziemy mieli kilkanaście klas.

Dyrektywa use pozwala zdefiniować jakiej przestrzeni nazw aktualnie używamy:

use User\Account\Shop\Shipping\Dhl;
include('class.userAccountDhl.php');
$dhl = new SendParcel();

Używając dyrektywy use PHP wie, że chodzi nam o klasę SendParcel która posiada przestrzeń nazw User\Account\Shop\Shipping\Dhl

--

W sytuacji jeśli mamy 2 klasy o tej samej nazwie i chcemy użyć dyrektywy use jest to możliwe ale musimy skorzystać z aliasów nazw.

use User\Account as UA; //Nasza przestrzeń ma alias UA
use User\Forum as UF;

include('class.userAccount.php');
include('class.userForum.php');
$uRegAccount = new UA\Register();
$uRegForum = new UF\Register(); //Korzystamy zarówno z przestrzeni nazw i aliasów aby wykluczyć błąd tej samej nazwy klasy.

Dzięki połączeniu przestrzeni nazw, dyrektywy use oraz aliasów możemy tworzyć czytelny kod bez obaw o jego kolizję z innymi klasami o tych samych
nazwach.

--


Dlaczego tak ważne jest aby nazwy przestrzeni nazw były zgodne ze strukturą katalogów. Załóżmy następującą strukturę katalogów:

classes
|__ User
|____ Account
|______ Register.php
|____ Forum
|______ Register.php

Nasza przestrzeń to przykładowo User\Account i plik z klasą z tej przestrzeni znajduje się w katalogu classes/User/Account/Register.php

Możemy skorzystać teraz z fukcji autoload:

function __autoload($class)
{
  $cl = str_replace('\\','/', $class);
  require_once(__DIR__.'/classes/' . $cl. '.php');
}

$uRegAccount = new User\Account\Register();

Dzięki zachowaniu nazw przestrzeni zgodnych ze strukturą katalogów funkcja __autoload wie, że ma załadować plik Register.php z katalogów User/Account

*/