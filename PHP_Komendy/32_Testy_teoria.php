<?php
/*
#Aby przetestować - wejdź do katalogu gdzie jest plik do testowania, a następnie w kosnoli wpisz:
../../../vendor/bin/phpunit nazwa_pliku.php

#Testowanie:
1.Ręczne:
-Łatwe na początku.
-Z czasem uciążliwe (a wręcz niemożliwe).
-Jest wolne.
-Podatne na błędy.

2.Automatyczne:
-Wymaga trochę wysiłku.
-Im dłużej trwa projekt, tym bardziej się zwraca.
-Zapewnia nam siatkę bezpieczeństwa.
-Może pomagać w programowaniu.
-Są rzeczy, które testuje się trudno (ale praktycznie nie ma rzeczy, których nie da się przetestować).
-Jest rzetelne (brak czynnika ludzkiego).

------

#Metody testowania:
1.Testowanie statyczne:
Polega na statycznej analizie napisanego kodu, sprawdzeniu jego składni i przepływu.
Najczęściej spotykane metody to:
-code review czyli przeczytanie kodu przez kilku developerów, zanim zostanie on dodany do projektu,
-zastosowanie programów sprawdzających wszystkie możliwości przepływu programu.

2.Testowanie dynamiczne:
Testy przeprowadzane na działającym programie. Ich zadaniem jest sprawdzenie, czy wyniki i zachowanie jest takie jak przewidywane przez nas wcześniej.
Testowanie dynamiczne powinno być rozpoczęte zanim program jest ukończony. (A najlepiej zanim program zacznie być tworzony).

3.Testy funkcjonalne:
Testy zakładające, że moduł jest „czarnym pudełkiem”, o którym wiadomo tylko, jak ma się zachowywać. Nazywamy je też testami czarnej
skrzynki (black-box testing).

4.Testy strukturalne:
Testy skupiające się na wewnętrznej pracy modułu, a nie na jego kooperacji z innymi modułami. Nazywamy je też testami białej skrzynki (white-box testing).

--------

#Poziomy testowania:
1.Testy jednostkowe (unit testing):
Najniższy poziom testów. Ich zadaniem jest sprawdzenie poszczególnych jednostek logicznych kodu (zazwyczaj klas i ich funkcji).
Tworzone przez deweloperów podczas pracy nad poszczególnymi funkcjonalnościami.

2.Testy integracji (integration testing):
Testy sprawdzające integracje poszczególnych interfejsów programu i ich wzajemne oddziaływanie.
-Metoda od dołu (bottom up) – metoda sprawdzająca najpierw najniższe części programu i budująca testy wzwyż.
-Metoda od góry (top down) – metoda sprawdzająca najbardziej ogólne moduły i budująca test w dół.
-Big Bang – metoda grupująca moduły wedle funkcjonalności.

3.Testy systemowe (end-to-end testing):
-Testy polegające na sprawdzaniu całego gotowego oprogramowania w celu znalezienia potencjalnych błędów wpływających na użytkownika.
-Testy te mają również na celu sprawdzenie, czy program nie wpływa na system, w którym działa.


--------

#Typy testów:
1.Testy poczytalności (Sanity tests)
Najmniejsza grupa testów sprawdzająca, czy podstawowa funkcjonalność systemu działa.

2.Testy dymne (Smoke tests) Grupa testów, których wykonanie trwa stosunkowo krótko. Pokazują one, czy można rozwijać dany kod.

3.Regresja (regression testing)
Niezamierzone zmiany wprowadzone zazwyczaj w komponencie, nad którym nie pracujemy, a który to komponent polega na aktualnie zmienianym.

4.Testy regresji (Regresiontests)
Testy sprawdzające, czy funkcjonalność pozostaje bez zmian między wersjami. Często pokazują zmiany, które nie są de facto błędami, ale
niechcianymi naruszeniami starego standardu.

--------

#Słowniczek:

Atrapy (dummy)
Obiekt w teście, który jest nam potrzebny jako wypełnienie, a nie spełnia żadnego logicznego celu. Możemy w tym celu wykorzystać nawet
pustą klasę.

Fake
Obiekt, który zawiera już logikę, ale nie taką jak prawdziwa implementacja. Na przykład tabelka z danymi zamiast bazy danych.

Zaślepka (stub)
Obiekt mający minimalną implementację potrzebnego przez nas interfejsu. Zazwyczaj funkcje zwracają dla jakiejś danej wejściowej predefiniowaną daną wyjściową.

Mock
Obiekt, który poza predefiniowaną daną wyjściową śledzi jeszcze wszystkie interakcje z interfejsem. Zazwyczaj bardziej skomplikowane
klasy. Najlepiej skorzystać już z dostępnych wchodzących w skład bibliotek.

---------

#Założenia przy pisaniu testów:
Każdy nasz test ma spełniać następujące założenia:
-Mieć nazwę klasy taką samą jak nazwa pliku,
-Dziedziczyć po jednej z klas testujących (np. PHPUnit_Framework_TestCase),
-Mieć publiczne metody zaczynające się od słowa test.

Przykładowy test:

class sampleTest extends PHPUnit_Framework_TestCase {
  public function testTrue()
  {
    $this->assertTrue(false, "First assertion failed");
  }
}

---------

#Asercje:
-Asercje to funkcje, które przerwą wykonywanie testu, jeżeli nie zajdzie podany warunek.
-Asercje to podstawa pisania testów.
-Do asercji zawsze jako ostatni argument możemy przekazać string, który zostanie wyświetlony w przypadku niespełnienia wymagań.

--

#Typy asercji:
Opis wszystkiego na stronie: https://phpunit.de/manual/current/en/appendixes.assertions.html

W PHPUnit jest ponad 30 asercji, które testują różne założenia. Np. użyta przez nas wcześniej funkcja assertTrue sprawdza, czy podany do niej
parametr konwertuje się na wartość true.

$this->assertTrue(true, "First assertion failed"); //pass
$this->assertTrue(false, "First assertion failed"); //fail
$this->assertTrue(1<5, "First assertion failed"); //pass
$this->assertTrue("foo"==="bar", "First assertion failed"); //fail

--

#Najważniejsze asercje:
-assertArrayHasKey(key, array) - Sprawdza, czy w tablicy znajduje się podany klucz.
-assertCount(expected, array) - Sprawdza wielkość podanej tablicy.
-assertEmpty(array) - Sprawdza, czy tablica jest pusta.
-assertEquals(expected, actual) - Sprawdza, czy podane zmienne są takie same.
-assertFalse(value) - Sprawdza, czy podana zmienna to false.
-assertNull(value) - Sprawdza, czy podana zmienna to null.
-assertSame(value1, value2) - Sprawdza, czy podane zmienne to ten sam obiekt.
-assertTrue(value) - Sprawdza, czy podana zmienna to true.

--

#Stringi:
Sprawdzają, czy podane w napisie założenia są spełnione.
-assertStringEndsWith(suffix, string)
-assertStringStartsWith(prefix, string)

#Liczby:
Sprawdzają, czy podane w liczbach założenia są spełnione.
-assertGreaterThan(expected, actual)
-assertGreaterThanOrEqual(expected, actual)
-assertLessThan(expected, actual)
-assertLessThanOrEqual(expected, actual)

*/