<?php
/*
WZORZEC PROJEKTOWY:
W inżynierii oprogramowania	uniwersalne, sprawdzone	w praktyce rozwiązanie często pojawiających	się, powtarzalnych problemów projektowych.
Pokazuje powiązania	i zależności między klasami	oraz obiektami.	Ułatwia	tworzenie, modyfikację,	oraz pielęgnację kodu źródłowego.
Wzorce projektowe stanowią abstrakcyjny opis zależności pomiędzy klasami, co w efekcie wprowadza pewną standaryzację kodu oraz zwiększa jego zrozumiałość, wydajność i niezawodność. Wartość wzorców projektowych stanowi nie tylko samo rozwiązanie problemu, ale także dokumentacja, która wyjaśnia cel, działanie, zalety danego rozwiązania, co pomaga w łatwiejszym stosowaniu i adaptacji wzorców w danym zastosowaniu.
-Jest opisem rozwiązania, a	nie	jego implementacją.
-Wzorce projektowe stosowane są	w projektach wykorzystujących programowanie	obiektowe.
-Źródło: https://pl.wikipedia.org/wiki/Wzorzec_projektowy_(informatyka)

--

Model-View-Controller (MVC)
Czym jest MVC?
Jest to	wzorzec	architektoniczny służący do organizowania struktury	aplikacji posiadających	graficzne interfejsy użytkownika. Zakłada podział aplikacji	na trzy	połączone z	sobą warstwy: model, widok i kontroler.

Model
Jest reprezentacją pewnego problemu, jej struktury danych. Model jest samodzielny. Model zajmuje się dostarczaniem danych do wykorzystania aplikacji. Do poprawnej pracy nie wymaga obecności dwóch pozostałych części	MVC. Komunikacja z nimi	zachodzi w sposób niejawny.

Widok
Jest odpowiedzialny	za prezentację danych w	obrębie	graficznego	interfejsu użytkownika. Może składać się z podwidoków zarządzających	mniejszymi	elementami składowymi. Widoki mają bezpośrednie	referencje do modeli, z	których	pobierają dane,	gdy otrzymują od kontrolera	żądanie	ich wyświetlenia. Możliwe są różne	widoki tych	samych danych.

Konrtoler
Jego zadaniem jest odbiór, przetworzenie oraz analiza danych wejściowych od użytkownika. Po	przetworzeniu odebranych danych kontroler może	wykonać	następujące czynności:
-zmienić stan modelu,
-odświeżyć widok,
-przełączyć	sterowanie na inny kontroler.


---

Co to jest framework?
Framework albo platforma programistyczna to	szkielet do	budowy aplikacji. Definiuje	on strukturę aplikacji oraz	ogólny mechanizm jej	działania,	a także	dostarcza zestaw komponentów i	bibliotek ogólnego przeznaczenia do	wykonywania określonych	zadań.
Programista	tworzy aplikację, rozbudowując i dostosowując poszczególne komponenty do wymagań realizowanego projektu. Tworzy	w ten sposób gotową	aplikację.
Frameworki bywają niekiedy błędnie zaliczane do bibliotek programistycznych. Typowe cechy, które każą wyróżniać je jako samodzielną kategorię oprogramowania, to:
- odwrócenie sterowania – w odróżnieniu od aplikacji oraz bibliotek, przepływ sterowania jest narzucany przez framework, a nie przez użytkownika.
-domyślne zachowanie – domyślna konfiguracja frameworka musi być użyteczna i dawać sensowny wynik, zamiast być zbiorem pustych operacji do nadpisania przez programistę.
-rozszerzalność – poszczególne komponenty frameworka powinny być rozszerzalne przez programistę, jeśli ten chce rozbudować je o niezbędne mu dodatkowe funkcje.
-zamknięta struktura wewnętrzna – programista może rozbudowywać framework, ale nie poprzez modyfikację domyślnego kodu.

Źródło: https://pl.wikipedia.org/wiki/Framework

---

Czym jest Symfony?
Symfony	to pełnowartościowy	framework służący do tworzenia dowolnej	skali aplikacji	webowych w PHP.	Stworzony i utrzymywany	przez firmę	SensioLabs.
Symfony	Components to zestaw bibliotek rozwiązujących typowe, powtarzalne zadania spotykane	przy programowaniu aplikacji webowych. Mogą	być	one
wykorzystywane	pojedynczo	i niezależnie od samego	frameworku.

Podstawowe korzyści:
-Szybkość - programista	skupia się na rozwiązywaniu problemów ściśle związanych	z zadaniem (logiką biznesową), a nie na	zadaniach okołobiznesowych,	czy	związanych z samą strukturą	projektu.
-Wzorce projektowe - budowanie aplikacji w oparciu o dobre praktyki	architektury oprogramowania.
-Utrzymanie	i rozwój aplikacji - wsparcie techniczne, bogata baza wiedzy oraz aktualizacje.
-Jakość - wykorzystanie	sprawdzonych rozwiązań w postaci gotowych komponentów o	wysokiej jakości kodu.
-Współpraca	zespołowa - ułatwiona współpraca zespołowa dzięki następującym zaletom: znany, dobrze udokumentowany kod oraz usystematyzowane pojęcia i narzędzia programistyczne.


-----


Jak	działa Symofony?
Symfony	zmienia	podstawowy sposób działania	aplikacji. Do tej pory różnym adresom w	każdej z naszych aplikacji odpowiadały różne pliki PHP. W	przypadku Symfony zasada jest trochę bardziej skomplikowana.
Pierwsza różnica jest już w	samym zapytaniu. Zamiast odwołania do konkretnego pliku	- odwołujemy się do ścieżki.
Co się dzieje po otrzymaniu	zapytania?
1.Zapytanie	trafia do front	controllera. Jest to plik PHP przejmujący wszystkie zapytania i	przekazujący dalej do frameworka. Dla Symfony jest to	plik /web/app.php (lub /web/app_dev.php	dla	serwera deweloperskiego).
2.Front	controller przesyła	nasze zapytanie	do silnika Symfony.
3.Silnik Symfony przesyła zapytanie	do Routera,	który zwraca informacje, jaki model	i jaka akcja jest przypisana do tego adresu.
4.Silnik Symfony uruchamia odpowiedni kontroler	i jego akcję.
5.Akcja	zwraca	widok, który powinien zostać wyświetlony użytkownikowi.


-----

STRUKTURA KATALOGÓW W SYMFONY

app
Główny katalog,	w którym znajduje się framework. Są	tu też pliki konfiguracyjne	i pliki	zasobów.

bin
Katalog, w którym znajdują się dane Doctrine.

vendor
Biblioteki zainstalowane przez Composera (w	tym	katalogu nic nie zmieniamy).

src
Katalog, w którym znajdują się poszczególne	bundle.

web
Folder „wystawiony”	publicznie przez serwer	HTTP, zawiera m.in.:
-front controller
-zasoby	CSS	i JS
-pozostałe zasoby tj. np. zdjęcia, pliki uploadowane przez użytkownika

------

KONSOLA:
Konsola	to jeden z komponentów Symfony. Jest to	zbiór narzędzi dostępnych z	linii poleceń, które pozwalają zarządzać projektem oraz	jego zasobami.
Aby	wylistować	dostępne polecenia konsoli, uruchamiamy	ją	bez	parametrów:
php	app/console


-------

BUNDLE:

Co to jest?
Symfony	zbudowane jest na podstawie Bundli.
Są to osobne części	działające całkowicie niezależnie i implementujące pewną funkcjonalność.
Bundle to w	uproszczeniu plugin.
W Symfony wszystko (łącznie	z podstawową funkcjonalnością) jest Bundlem.

Do czego używamy?
W naszym przypadku kod dopisanej przez nas funkcjonalności powinien znajdować się w	osobnym	Bundlu. Dzięki temu	nasza funkcjonalność
będzie łatwo przenoszalna między projektami.

Jak	wygląda	katalog	Bundla?
/Controller
Tutaj znajdują się wszystkie kontrolery danego Bundla.

/DependencyInjection
Tutaj znajdują się klasy odpowiedzialne	za Dependency Injection. Ten katalog nie zawsze	istnieje.

/Resources/config
Konfiguracja danego	Bundla.

/Resources/views
Widoki trzymane	dla	każdego	kontrolera osobno (w katalogu z	jego nazwą).

/Resources/public
Wszystkie zasoby potrzebne do działania Bundla (kopiowane do /web przy użyciu komendy assets:install).

Tests
Tutaj znajdują się testy dla danego	Bundla.

--

Tworzenie nowego Bundla:

Nowego Bundla tworzymy następującą komendą:
php	app/console	generate:bundle
Następnie generator	przeprowadza nas przez proces tworzenia	nowego Bundla.
Musimy podać następujące dane:
-Namespace i nazwę (najlepiej, gdy są takie	same).
-Sposób	konfiguracji (annotacje).
-Ścieżkę do	Bundla (zostawiamy podstawową).
-Czy ma	wygenerować	nam	strukturę katalogu?	(Tak).
-Czy ma	automatycznie dopisać nasz Bundle do routingu i	kernela? (2xtak).

Nazywanie naszych Bundli:
Nazwa Bundla powinna spełniać następujące warunki:
-Być pisana	za pomocą camelCase.
-Nie zawierać znaków specjalnych i spacji.
-Nie być dłuższa niż dwa słowa.
-Kończyć się słowem	Bundle.


--

Usuwanie Bundla:

Krok 1:
Usunąć wpis	(wszytskie linie) znajdujący się w pliku /app/config/routing.yml zaczynający się od nazwy	bundla.

np. Bundle o nazwie	Coderslab wygląda następująco:

coderslab:
		resource:	"@CoderslabBundle/Controller/"
		type:		annotation
		prefix:			/


Krok 2:
Usunąć kod tworzący	nowy obiekt	Bundla.	Znajduje się on	w pliku /app/AppKernel.php w tablicy $bundles. Usuwamy linę z bundlem np:
new	CoderslabBundle\CoderslabBundle(),

Krok 3:
Usuwamy	katalog, w którym znajduje się Bundle. Jest	on zlokalizowany w /src/nazwaBundla



----------
----------

KONTROLER
Kontroler jest podstawową klasą, którą	będziemy implementować,	pisząc	projekty w Symfony.
Jego zadaniem jest otrzymanie zapytania	HTTP i wygenerowanie odpowiedzi.
Kontrolery powinny implementować całą logikę biznesową naszej aplikacji	(jeden kontroler zazwyczaj przypada	na jeden model ale nie jest to	regułą).

Generowanie	kontrolera:
Kontroler możemy w łatwy sposób wygenerować	za pomocą konsoli:
php	app/console	generate:controller

Następnie generator	przeprowadza nas przez proces tworzenia	nowego kontrolera. Musimy podać:
-nazwę	kontrolera (poprzedzoną	nazwą Bundla, do którego zostanie dodany),
-format	routingu (wybieramy	adnotacje),
-format	templatów (wybieramy Twig),
-możemy	dodawać	akcje (na razie	nie	dodajemy).

Nazwa kontrolera
Nazwa kontrolera powinna spełniać następujące warunki:
-kończyć się słowem	Controller (jeżeli używamy generatora, to on sam doda je na koniec),
-używać	camelCase,
-składać się z maksymalnie czterech	członów,
-mieć taką samą	bazę (początek nazwy) jak model, którym	będzie sterował.


Klasa bazowa:
Kontroler w	Symfony	powinien (ale nie musi)	dziedziczyć	po klasie bazowej o	nazwie Controller.
Dzięki	niej mamy dostęp do	wielu wbudowanych funkcjonalności, które będą nam przydatne.
Pamiętaj o jej dodaniu,	jeżeli piszesz klasę sam (generator	doda ją	automatycznie).

--

Akcje kontrolera:
Akcje są metodami, które będą wywoływane przez Symfony w następujących przypadkach:
-gdy jakiś użytkownik będzie chciał wejść na przypisany	do nich	adres URL,
-gdy zostaną wywołane przez	inną akcję

Zazwyczaj jedna	akcja skupia się na	jednej funkcjonalności.	Dla	kontrolera użytkowników	to:
-stworzenie	nowego użytkownika
-wczytanie wszystkich użytkowników,
-wczytanie użytkownika o podanym id.

Akcje muszą	spełniać następujące założenia:
-być publiczne,
-kończyć się słowem	Action,
-zwracać obiekt	typu Response (bardzo ważne!)
Symfony	samo przeskanuje nasz plik i wczyta	wszystkie akcje.

Żeby zwrócić prosty	obiekt Response, musimy	najpierw wczytać jego klasę
use	Symfony\Component\HttpFoundation\Response

Następnie w	akcji:
return new Response('<html><body>Hello	World!</body></html>');


-------
-------

PODSTAWOWY ROUTING

Możemy przypisać podstawowy	URL	do danej akcji wyorzystując adnotację @Route("url").
Adnotacja ta ma	więcej zastosowań:
-może przyjmować parametry do akcji	(coś podobnego do GET),
-nadawać akcji alias (name), dzięki	któremu	będziemy mogli się do niej odnosić z innych części kodu.


Nadawanie akcjom aliasów:
Adnotacja @Route może przyjmować jeszcze parametr, który nada nam alias danej akcji.

/**
*	@Route("/hello", name="hello")
*/

/*
Jeżeli go nie podamy, to nazwa akcji budowana jest na zasadzie:
NazwaBundla_NazwaKontrolera_NazwaAkcji


--

Przekazywanie parametrów do	akcji:
Jednym	z najpotężniejszych	mechanizmów	wprowadzonych przez	URI	(czyli nowy	system adresów)	jest możliwość łatwego i intuicyjnego wprowadzania parametrów. Np.:
www.mypage/post/4 	–	powinno	nas	przekierować do	postu o	id 4,
www.mypage/post/6 	–	powinno	nas	przekierować do	postu o	id 6.

Dzięki podaniu parametru w ścieżce URL,	czyli tzw. sluga, możemy łatwo przenieść część informacji jako parametr	do	naszej	akcji.
/**
*	@Route("/helloWorld/{sentence}")
*/
public function helloWorldAction($sentence)
{
    return	new	Response(
        "<html><body>Hello World!"	+
        "Your sentence is: $sentence</body></html>"
    );
}

//albo jeszcze inny przykład:

/**
 *	@Route("/hello/{userName}/{userSurname}")
 */
public function	helloAction($userName, $userSurname){
    return new	Response(
        "<html><body>Welcome $userName $userSurname</body></html>"
    );
}

//w @Route("/hello/{userName}/{userSurname}") kolejne slugi są rozdzielane ukośnikami "/".
/*
