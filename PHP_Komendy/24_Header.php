<?php
/*
#Nagłówki HTTP:

Odpowiedzi serwera składają się nie tylko z przesyłanych danych, które są wyświetlane następnie przez przeglądarkę. W komunikacji przeglądarki z serwerem używane są również nagłówki pozwalające przesłać dodatkowe informacje związane z połączeniem lub dodatkowe dane.

Nagłówki przyjmują postać klucz-wartość, zapisywane w postaci:
Klucz: wartość
Np:
Content-Type: application/json
Connection: keep-alive

Nagłówki dzielą się na:
-Nagłówki żądania czyli przesyłane od klienta do serwera, te nagłówki są wysyłane jako pierwsze.
-Nagłówki odpowiedzi czyli przesyłane przez serwer do klienta.

Nagłówki HTTP:

NAGŁÓWEK
Content-Type: Określa jakiego typu dane są przesyłane
Content-Length: Zawiera informację ile danych jest przesyłanych
Cookie: Przechowuje informacje o ciasteczkach wraz z ich zawartością
Location: W odpowiedzi nakazuje przeglądarce przejście pod inny adres
Last-Modified: Informuje kiedy ostatnio nastąpiła zmiana źródła np. obrazka
Content-Disposition: Pozwala wymusić na przeglądarce pobranie danych zamiast ich wyświetlenia
Host: Nagłówek obowiązkowy, wskazuje na adres jaki chcemy przesłać żądanie
Accept: Pozwala przekazać informację jakiego typu dane są akceptowane
User-Agent: Nazwa przeglądarki wraz z dodatkowymi informacjami na jej temat
Referer: Adres URI jaki przekierował nas na daną stronę np. po wyszukaniu w Google
Allow: Określa metody akceptowane przez serwer GET, POST, HEAD
Connection: Pozwala ustalić czy połączenie po zakończeniu żądania ma zostać zakończone czy potrzymane tzw. keep-alive

Oprócz standardowych nagłówków można wprowadzać też swoje własne, aby przekazać dodatkowe informacje (np. pozwalające na łatwiejsze debugowanie).
header("Moja-informacja: 123456");

Szczegółowa lista nagłówków:
https://pl.wikipedia.org/wiki/Lista_nag%C5%82%C3%B3wk%C3%B3w_HTTP


#Funkcja header:
-Funkcja pozwalająca na kontrolowanie nagłówków wysyłanych przez serwer w odpowiedzi na zapytanie do naszego skryptu.
-Funkcja musi być użyta przed wysłaniem jakiejkolwiek innej treści do przeglądarki. Również informacji o błędach.
-Użyta później generuje ostrzeżenie (headers already sent) i nie modyfikuje już nagłówków.


void header ( string $string [, bool $replace = true
[, int $http_response_code ]] )
header('My-header: http://coderslab.pl');
$someText = 'zadzialam';
echo $someText; //Skrypt wykona sie prawidłowo

$someText = 'niezadzialam';
echo $someText;
header('My-header: http://coderslab.pl '); //Skrypt zwróci błąd ponieważ przed wysłaniem nagłówka, do przeglądarki przesłano dane przez funkcję echo

#Popularne użycia:
Przekierowanie:
header("Location: http://www.example.com/");

Zmiana typu zwracanej zawartości (image, json, xml, pdf):
header('Content-Type: application/pdf');

Polecanie przeglądarce zapisać zwracaną zawartość jako plik:
header('Content-Disposition: attachment; filename="downloaded.pdf" ');
header('Content-Transfer-Encoding: binary');
header('Content-Length: 27641');

Cache:
header("Cache-Control: no-cache, must-
revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header('Pragma: no-cache');

Kontrola dostępu:
header(' WWW-Authenticate: Basic realm="My Realm" ');
header('HTTP/1.0 401 Unauthorized');

Data ostatniej modyfikacji:
$time = time() - 60; // or filemtime($fn), etc
header('Last-Modified: '.gmdate('D, d M Y H:i:s', $time).' GMT');


#Inne funkcje:

bool headers_sent ([ string &$file [, int &$line ]] )
-Sprawdza, czy nagłówki zostały już wysłane, tzn., czy możemy jeszcze dodać własne nagłówki czy nie.
-Jeżeli zostaną podane zmienne $file i $line, to zostanie w nich zapisane, w którym miejscu wysłano pierwszą część odpowiedzi.

int http_response_code ([ int $response_code ] )
-Ustawia kod odpowiedzi HTTP, domyślny to 200.
-Tę funkcję można wykorzystać do zwrócenia błędu HTTP, np. 404, 500 lub też niestandardowej odpowiedzi z rodziny 2XX.


#Kod odpowiedzi serwera:
Za pomocą nagłówków możemy także kontrolować odpowiedź serwera przesyłaną do przeglądarki.
Najpopularniejsze kody odpowiedzi to:
-200 – wszystko ok
-403 – brak autoryzacji, strona nie dostępna bez podania danych autoryzacyjnych
-404 – nie znaleziono strony pod podanym adresem
-500 – wewnętrzny błąd serwera, należy przejrzeć logi serwera
-301 – strona przekierowana na stałe pod inny adres
-101 – zmiana protokołu np. przy używaniu WebSocket

Zmiana kodu odpowiedzi serwera:
header('HTTP/1.1 404 Not Found');
header('HTTP/1.1 403 Forbidden');
header('HTTP/1.1 301 Moved Permanently');
header('HTTP/1.1 500 Internal Server Error');

 */

#Przykład:
header ('Location: http://www.google.com');