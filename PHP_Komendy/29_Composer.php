<?php
/*
#Composer - system wspomagający zarządzanie zależnościami aplikacji w PHP.

Załóżmy, że wykonanie skryptu index.php jest zależne od istnienia pliku funkcje.php. Plik funkcje.php jest swego rodzaju biblioteką programistyczną. Biblioteka to plik (lub zestaw plików) dostarczający funkcje, klasy, metody lub dane, które mogą zostać wykorzystane w kodzie
źródłowym programu. Załóżmy, że chcemy w naszym skrypcie użyć jakiejś biblioteki udostępnionej w internecie. Nie chcemy fizycznie pobierać tej biblioteki, mamy tylko zdefiniować, jakie biblioteki są wymagane przez nasz skrypt. Pobraniem tych bibliotek zajmie się Composer.

--

#Composer – instalacja i konfiguracja:

System Linux
W katalogu swojego projektu wykonaj polecenie:
curl -s https://getcomposer.org/installer | php

System Windows
Pobierz i uruchom instalator https://getcomposer.org/Composer-Setup.exe

W katalogu swojego projektu utwórz plik composer.json – będzie on zawierał wpisy, które poinformują Composera, jakich bibliotek wymaga nasz skrypt.

Można również wywołać z konsoli komendę composer init

Załóżmy, że chcemy pobrać bibliotekę służącą do zapisywania (logowania) informacji o działaniu skryptu do jakiegoś loga (pliku .log).

Z listy dostępnej na tej stronie:
https://packagist.org/explore
wybieramy bibliotekę Monolog:
https://packagist.org/packages/monolog/monolog

Strona packagist.org jest wyszukiwarką pakietów dostępnych do instalacji

--

#Composer – konfiguracja:

require – jest słowem kluczowym oznaczającym, jakie biblioteki są wymagane w naszym projekcie.
monolog/monolog – (autor/nazwa) to skrócona nazwa biblioteki.
1.0.* – wersja danej biblioteki. Gwiazdka oznacza, że Composer ma zainstalować zawsze najnowszą wersję biblioteki.

Przykład pliku composer.json:

{
"require": {
  "monolog/monolog": "1.0.*"
  }
}

--

#Composer – instalacja bibliotek:
Po zdefiniowaniu zależności naszego skryptu możemy pozwolić Composerowi działać – pobierze on biblioteki, od których jest zależny nasz skrypt.

System Linux
W katalogu swojego projektu wykonaj polecenie:
php composer.phar install

System Windows
W katalogu swojego projektu wykonaj polecenie:
composer install

Pobrane biblioteki Composer umieści w katalogu vendor, który zostanie utworzony w katalogu projektu.
Zostanie także utworzony plik vendor/autoload.php, który musimy dołączyć do naszego skryptu, umieszczając na jego początku polecenie:
require 'vendor/autoload.php';

Pamiętaj aby katalogu vendor nie dodawać do repozytorium ponieważ wówczas traci sens idea używania Composera.

--

#Composer – użycie:

<?php
  require 'vendor/autoload.php';
  use Monolog\Logger;
  use Monolog\Handler\StreamHandler;
  echo('Prosty przykład użycia loggera Monolog<br>');

// utworzenie kanału logowania
  $log = new Logger('infoLogger');
  $log->pushHandler(new StreamHandler(__DIR__ . '/log/info.log', Logger::DEBUG));
  $log->addInfo('skrypt rozpoczął działanie');

  for($i = 0; $i < 10; $i++) {
   $log->addInfo($i . '. obrót pętli');
  }
  $log->addInfo('skrypt zakończył działanie');
?>


--

#Moje notatki/wnioski:

W katalogu, w którym tworzymym projekt trzeba wgrać plik composer.json, który zawiera następujące linijki kodu:

--------composer.json----------
{
  "require-dev":{
    "phpunit/phpunit":"4.8.*"
  }
}
-------koniec composer.json-------

Następnie uruchamiamy terminal, wchodzimy do tego katalogu, gdzie jest plik composer.json i wpusujemy komendę:
composer install -vvv
Zaistaluje się nam wtedy katalog "vendor", w którym jest między innymi podkatalog "bin", a w nim plik phpunit.

W pliku, w którym jest testowany program powinniśmy najpierw dać komendę php:
require ('../../../vendor/autoload.php');

Testy przeprowadza się z konsoli wpisując:
../../../vendor/bin/phpunit nazwa_pliku.php