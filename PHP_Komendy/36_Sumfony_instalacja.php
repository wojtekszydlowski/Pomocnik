<?php
/*
Symfony można pobrać ze strony: http://symfony.com/doc/current/book/installation.html
Od wersji 2.7 jedynym polecanym sposobem tworzenia nowych projektów	w oparciu o	Symfony	jest użycie	narzędzia Symfony Installer.

----

TWORZENIE NOWEGO PROJEKTU SYMFONY

Aby swtorzyć projekt symfony trzeba wejść w kosoli do katalogu, w którym chcemy go stworzyć (nie tworzyć katalogu projektu, ale wejść do katalogu, gdzie ten projekt i katalog ma postwać np. do katalogu Workspace) a następnie w konsoli wpisać komendę:
symfony new nazwa_projektu 2.8
np. symfony new projekt_1 2.8

Teraz trzeba urochomić serwer. Należy wejść do katalogu projektu a następnie wpisać w konsoli:
php app/console server:start 127.0.0.1:8080 - będziemy mieli to na porcie 8080 - tak skonfigorowane jest przec Coderslab

Po takim uruchomieniu serwera jeśli wejdzie się na stronę:
http://127.0.0.1:8080/ lub localhost:8080
pojawi się nam ekran "Welcome to Symfony...", gdzie na dole będzie już uruchomiony profiler

Domyślnie został też utworzony bundle - AppBundle. Jego będzie można później usunać, gdy się stworzy swój własny boundle, albo jego można rozszerzać

-----

URUCHAMIANIE BUNDLE'A:
W kalaogu, w którym jest projekt (u nas np. projekt_1) wpisujemy w konsoli:
php	app/console	generate:bundle (no, później entery, pamiętać, żeby dać annotations).

Nazwa bundle'a - NazwaBundle
Configuration format: annotations





------------------
------------------
NOTATKI Z ZAJĘĆ
------------------
------------------

Aby swtorzyć projekt symfony trzeba wejść w kosoli do katalogu, w którym chcemy go stworzyć a następnie w konsoli wpisać komendę:
symfony new nazwa_projektu 2.8
np. symfony new projekt_1 2.8

i wtedy wchodzimy do tego katalogu (cd projekt_1) i możemy już np. uruchomić konsolę:
php app/console

Aby uruchomić serwer deweloperski należy wpisać w konsoli:
php	app/console	server:start 0.0.0.0:8080 / wtedy jest widoczny we wszystkich interfaceach (zbindował sie na wszystich interfaceach), można dodać php app/console server:start 127.0.0.1:8080 - wtedy będzie tylko na localhost

Aby wejść do profilera należy wpisać wtedy w pasku przeglądarki:
http://127.0.0.1:8080/ lub localhost:8080

pojawi się strona z "Welcome to Symfony 2.8.22" i na dole strony będzie uruchomiony profiler - wystarczy na nim kliknąć i wejdziemy do niego

Domyślnie został też utworzony bundle - AppBundle. Jego będzie można później usunać, gdy się stworzy swój własny boundle, albo jego można rozszerzać

Gdyby pojawiły się jakieś problemy (np. ze strefą czasową) w kolsoli należy wpisać:
sudo gedit /etc/php/7.0/cli/php.ini
i tam gdzie jest [Date] odkomentować linię:
date.timezone = Europe/Warsaw
z edytora wychodzimy CTRL+c

Strona której jeszcze nie ma np.:
http://127.0.0.1:8080/noSuchPage lub localhost:8080/noSuchPage

----------------

URUCHAMIANIE BUNDLE'A:

W kalaogu, w którym jest projekt (u nas np. projekt_1) wpisujemy w konsoli:
php	app/console	generate:bundle (no, później entery, pamiętać, żeby dać annotations).

i następnie przechodzimy przez proces rejestracji boundle'a

wtedy wchodzimy do katalogu src i do naszego nowego katalogu z bundlem (np. myFirstBundle) i tam w Controller jest plik DefaultController.php:
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
/*
public function indexAction()
{
    return $this->render('myFirstBundle:Default:index.html.twig');
}
}


wtedy zmieniamy w:
@Route("/hallo/world")
wtedy napis "Hallo World!" pojawi się jak w przeglądarce wpiszemy:
http://localhost:8080/hallo/world


----

USUWANIE BUNDLE'A:
Najpierw wchodzimy do katalogu: /app/config/routing.yml i usuwamy linie:

my_first:
    resource: "@myFirstBundle/Controller/"
    type:     annotation
    prefix:   /

Krok 2: wchodzimy do /app/AppKernel.php i usuwamy linię:
new myFirstBundle\myFirstBundle(),

Krok 3: Usuwamy	katalog, w którym znajduje się Bundle. Jest	on zlokalizowany w /src/nazwaBundla