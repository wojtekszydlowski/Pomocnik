<?php

//TEORIA:

/*
//TWIG:

Przykładowy plik:
<!DOCTYPE html>
<html>
 <head>
  <title>Welcome	to	Symfony!</title>
 </head>
 <body>
  <h1>{{ page_title	}}</h1>
  <ul id="navigation">
	{% for item	in navigation %}
     <li>
       <a href="{{ item.href }}">
	   {{ item.caption }}
	   </a>
     </li>
	{% endfor %}
  </ul>
 </body>
</html>

#ZMIENNE:

W celu odwołania si do elementów w tablicach używamy nawiasów kwadratowych:
{{ foo2['bar'] }}
Wyświetlenie zawartości	komórki	o kluczu bar z tablicy foo2

W celu odwołania się do	własności obiektów lub ich metod używamy znaku kropki:
{{ foo.bar }}
Wyświetlenie atrybutu bar z	obiektu	foo


---

#FILTRY:

Zmienne	w Twigu	mogą być modyfikowane przez	tzw. filtry. Filtry	od zmiennych oddzielamy	znakiem	|.
Można stosować wiele filtrów dla zmiennej, zostaną one nałożone	w kolejności.

Filtr można	też	nałożyć	na blok	kodu, stosując tag filter:

{% filter upper	%}
 This text becomes uppercase
{% endfilter %}

Filtry wbudowane w Twig: http://twig.sensiolabs.org/doc/filters/index.html

---

#FUNKCJE W TWIGU:
Twig ma	też	zestaw funkcji pełniących funkcję pomocniczą. Funkcji –	w odróżnieniu od filtrów – nie nakłada się na zmienne w	celu modyfikacji ich wartości.

Funckje w Twigu: http://twig.sensiolabs.org/doc/functions/index.html

---

#INSTRUKCJE WARUNKOWE:
{% if v	>1	%}
  {# zmienna v większa od 1 #}
{% elseif v	== 1 %}
  {# zmienna v równa 1 #}
{% else	%}
  {# w pozostałych przypadkach,	tj.	zmienna	v mniejsza od 1	#}
{% endif %}

---

#OPERATORY LOGICZNE:
b-and
b-xor
b-or
or
and
==
!=
<
>
>=
<=
in
matches
starts with
ends with
is
not


{% if v	is null	or (v is not null and v	<= 0) %}
				{#	...	#}
{% elseif v	not	in [1,	2,	3]	%}
			    {#	...	#}
{% elseif v	matches	'/wyrazenie_regularne/'	%}
				{#	...	#}
{%	elseif v starts	with 'a' %}
				{#	...	#}
{% endif %}


---

#OPERATORY MATEMATYCZNE:
+
-
*
/
%
** - Operator potęgowania
// - Operator dzielenia	zwracający liczbę całkowitą (podłogę)


---


#PĘTLA FOR:
Jej	działanie jest zbliżone	do	pętli foreach w	PHP. Da	się	dzięki niej	przeiterować jakąś kolekcję	(np. tablicę) np.:
{% for val in arr %}
	{#	...	#}
{% endfor %}

Albo jeżeli	interesują nas też klucze:
{% for key,	val	in arr %}
 {{	key	}} : {{	val	}}
{% endfor %}


Jednym z usprawnień	pętli w	Twigu jest warunek else (jeśli nie mamy po czym iterować).
{% for val in arr %}
	{# ...	#}
{% else	%}
	{# ...	#}
{% endfor %}


---


#ZAŁĄCZANIE INNYCH SZABLONÓW:

Include:
Najprostszym sposobem użycia innego szablonu jest metoda include (możemy przekazać zmienne).

{% for post	in posts %}
 {{ include('post/show.html.twig',	{'post':post})}}   //tutaj przekazujemy zmienną post
{% endfor %}

W pliku:
app/Resources/views/post/show.html.twig:

<h2>{{ post.title }}</h2>
<h3	class="byline">by {{ post.authorName }}</h3>
<p>
 {{	post.body }}
</p>


---

#ZAŁĄCZANIE KONTROLERÓW:
W bardziej skomplikowanym przypadku możemy w widoku	wywołać	akcje kontrolera. W	tym	celu używamy standardowej notacji:
BundleName:ControllerName:Action

np.:
<div id="sidebar">
  {{ render(controller('AppBundle:Article:recentArticles',	{'max':	3})) }} //tu też przekazujemy do akcji zmienną max=3
</div>


---

#DZIEDZICZENIE SZABLONÓW:
Dziedziczenie pozwala tworzyć szablony zawierające bloki, które	mogą zostać nadpisane przez	szablony potomne. Wykorzystujemy w tym celu takie tagi jak:
-extends
-block

Szablon bazowy:
<!DOCTYPE	html>
<html>
 <head>
  {% block head	%}
  <link	rel="stylesheet" href="style.css" />
  <title> {% block title %}{% endblock %} | My Webpage</title>
  {% endblock %}
 </head>
 <body>
  <div id="content">{% block content %}{% endblock %}</div>
  <div id="footer">
	{% block footer	%}
	© Copyright	2011 by	<a href="http://...">Something</a>.
	{% endblock	%}
  </div>
 </body>
</html>

W szablonie	znajdują się tagi block, a każdemu z nich nadajemy nazwę.
Dzięki temu	w szablonie, który będzie dziedziczył po naszym	szablonie bazowym, będziemy mogli wypełniać	tylko te bloki,	na których nam zależy.
Jeżeli nie nadpiszemy jakiegoś bloku, to zostanie tam zawartość	z szablonu bazowego.


Szablon	dziedziczący z szablonu bazowego może wyglądać następująco:

{% extends "base.html" %}

{% block title %}Index{% endblock %}  // Nadpisujemy blok title	odpowiednią wartością
{% block head %} //W bloku head pozostawiamy wartość z szabonu bazowego	(parent()) oraz dodajemy link
  {{ parent() }}
	<style type="text/css" href="style_2.css"></style>
 {%	endblock %}
{% block content %} //Nadpisujemy blok content
 <h1>Index</h1>
  <p class="important">Welcome on my awesome homepage.</p>
{% endblock %}


---

#LINKI DO INNYCH STRON: path() i url()

Metoda path() przyjmuje	nazwę akcji, do której ma kierować,	i opcjonalnie tablicę, w której musimy podać wszystkie potrzebne do	wygenerowania tego	adresu slugi.

{% for article in articles	%}
 <a href="{{ path('article_show', {'id': article.id})	}}">
  {{ article.title	}}
 </a>
{% endfor %}

Metoda ta zwraca ścieżkę relatywną (bez	domeny).


Nazwę akcji	mogliśmy nadać przy	pomocy adnotacji @Route().
Jeżeli tego	nie	zrobiliśmy,	to akcja ma nadaną domyślną	nazwę:
(nazwaKontrolera_nazwaAkcji)

Wszystkie nazwy	akcji można	zobaczyć dzięki	komendzie konsolowej:
php	app/console	debug:router

Linki do zasobów
Z czasem w naszej aplikacji	zasoby będą	rosły (pliki JS, CSS, obrazy). Do tworzenia	dynamicznych linków	należy używać metody asset().

Gdzie trzymać zasoby?
Zasoby możemy trzymać w	dwóch miejscach:
-w naszym bundlu (src\myBundleName\Resources\public),
-bezpośrednio w	katalogu web (uznawane teraz za	najlepszą praktykę) -> pamiętajmy jednak o tym, żeby stworzyć katalogi /css, /js, /images.



----

#TŁUMACZENIA - USTAWIENIA REGIONALNE:
Wszelkie teksty	jakie umieszczamy w szablonach twiga możemy umiędzynarodowić z wykorzystaniem ustawień regionalnych	(ang. locale).

Do uruchomienia	tłumaczeń w	symfony potrzebujemy kilku kroków:
1. Skonfigurowania usługi Translation,
2. Zmiany sposobu prezentacji łańcuchów tekstowych
3. Utworzenia pliku	z tłumaczeniem dla danego języka

1.Domyślnie usługa Translation jest wyłączona.
Aktywacja usługi wymaga	usunięcia komentarza w pliku config.yml	w linii zawierającej następujący wpis:
#translator: { fallbacks: ["%locale%"] }   // # - usuwamy

W pliku	tym	możemy również zmienić domyślny	język używany przez	naszą aplikację.
parameters: locale: en

2.Zmiana sposobu prezentacji tekstu:
W widoku możemy	użyć funkcji trans w następujący sposób tuż po tłumaczonym tekście:
{{ 'Hello world' | trans }}

Wyrażenie Hello world zostanie zamienione na to, odpowiadające aktualnym ustawieniom regionalnym.


3.Plik z tłumaczeniem:
Ostatnią częścią procesu jest utworzenie pliku,	który zawierał będzie wyrażenia	do podmiany.

Plik ten należy	utworzyć w katalogu:
<bundleName>/Resources/translations/

Prawidłowa nazwa pliku dla języka polskiego	powinna	wyglądać następująco:
messages.pl.xlf

Zawartość pliku	xlf	z tłumaczeniami:
<?xml version="1.0"?>
<xliff version="1.2" xmlns="urn:oasis:names:tc:xliff:document:1.2">
 <file source-language="en"	datatype="plaintext" original="file.ext">
  <body>
   <trans-unit id="1">
	<source>Hello world</source>
	<target>Witaj świecie</target>
   </trans-unit>
  </body>
 </file>
</xliff>


Więcej na: http://symfony.com/doc/2.8/components/translation.html#using-message-domains
*/


/*
Zad 1:
Stwórz nową akcję przypisaną do adresu /render.
Podepnij do niej widok view_ex_a3.html.twig (który możesz znaleźć w katalogu z zadaniami).
Widok ten nie przyjmuje żadnych danych.
Dodaj ten szablon w dwa miejsca:
-w katalog Bundla
-w katalog app/Resources/...


Odp:
Należy wejść do 3_Widoki_i_Twig -> 1_Widoki - >projekt_view -> src - >AppBundle->Controller->pli views.Controller.php
Ten plik veiw_ex_a3.html.twig przeniosłem do katalogu projekt_view -> app -> Resources-> views -> Views i dałem w viewsController.php:
*/

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class viewsController extends Controller
{
    /**
     * @Route("/render/")
     */
public function nowaAkcjaAction()
{
    //app/Resources/views/views/view_ex_a3_html.twig
    return $this->render("Views/view_ex_a3.html.twig");
    //$this->render('hello/index.html.twig',['name'	=>	$name]); //tak można zmienną name przekazać do szablonu


/**
 * @Route("/renderA/")
 * @Template("Views/view_ex_a3.html.twig")
 */

public function akcjaAnnotationsAAction () {
    return [];
}

/**
 * @Route("/renderB/")
 * @Template(":Views:view_ex_a3.html.twig")
 */

public function akcjaAnnotationsBAction () {
    return [];
}
}

//------------

//ZADANIA - SKŁADNIA TWIGA


/*
Zad 1:

Stwórz nową akcję przypisaną do adresu /render/{username}.
Podepnij do niej widok view_ex_b1.html.twig (który możesz znaleźć w katalogu z zadaniami).
    Widok ten przyjmuje jedną zmienną o nazwie username.
Przekaż ją.
*/
//Odp:
//przeniść plik view_ex_b1.html.twig do katalogu app/Resources/views/Views/ i dodać:

    /**
     * @Route("/render/{user}/")
     */
    public function nowaAkcjaUsernameAction($user)
{
    //app/Resources/views/views/view_ex_a3_html.twig
    return $this->render("Views/view_ex_b1.html.twig",['username' => $user]);
}


//A tak wygląda plik view_ex_b1.html.twig
/*
{% extends "::base.html.twig" %}

    {% block title %}Witaj w widoku dla zadania B1{% endblock %}

{% block body %}
    <h1>Witaj w widoku dla zadania B1</h1>
    <p>
Zmienna przesłana z kontrolera to: {{ username }}
    </p>
{% endblock %}

*/

//---------------

/*
Zad 2:
    Przerób zadania:
        3 z działu 1_Widoki
        1 z aktualnego działu
    W taki sposób, żeby skorzystać z adnotacji @Template.
    Nie usuwaj starego rozwiązania, tylko je zakomentuj.


ODp:
*/

    /**
     * @Route("/render/{user}/")
     * @Template("Views/view_ex_b1.html.twig")
     */

    public function nowaAkcjaUsername2Action ($user) {
        return ['username' => $user];
    }

//---------------

/*
Zad 3:

Stwórz akcję podpiętą do adresu /repeatSentence/{n}.
Do akcji dopisz widok, który powtórzy n razy zdanie Symfony jest fajne.
Pętle wykonaj w szablonie, przekaż do niego liczbę powtórzeń.

Zmodyfikuj swoje rozwiązanie w taki sposób, żeby zdanie, które wyświetlasz, było przekazane z kontrolera.
Dopiero w chwili, w której zdanie nie jest przekazane, ma się wyświetlić napis:
Symfony jest fajne.
*/

//ODP: W pliku viewsController.php

    /**
     * @Route("/repeatSentence/{n}/")
     * @Template("Views/repeat_sentence.html.twig")
     */

    public function repeatSentenceAction ($n) {
    return ['n' => $n];
}

//i robimy plik repeat_sentence.html.twig, w którym dajemy:
/*
<html>
<body>
 <ol>
  {%  if n >0 %}
  {%  for i in range (1,n) %}
  <li>Symfony jest fajne: {{ i }}</li>
  {%  endfor %}
  {% endif %}
 </ol>
</body>
</html>

*/


/*
Zad4:

Stwórz akcję podpiętą do adresu /createRandoms/{start}/{end}/{n}.
Akcja ma generować tablicę z n losowymi liczbami z zakresu start do end, którą prześlesz do swojego widoku.
Następnie w Twigu użyj pętli for żeby wyświetlić wszystkie przesłane liczby.
Jeżeli tablica jest pusta (czyli podane n jest mniejsze lub równe 0) wyświetl odpowiednią informacje.


ODP:
W kontrolerze (viewsController.php):
 */

namespace AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
    use AppBundle\Entity\Article;

class viewsController extends Controller
{
    /**
     * @Route("/createRandoms/{start}/{end}/{n}/")
     * @Template("Views/create_randoms.html.twig")
     */

    public function createRandomsAction($start, $end, $n)
    {
        $array = [];
        for ($i = 0; $i < $n; $i++) {
            $randomNumber = rand($start, $end);
            $array[] = $randomNumber;

        }
        if ($n <= 0) $array[] = "N mniejsze lub równe zero";
        return ['array' => $array];
    }
}

//i teraz w pliku create_randoms.html.twig dajemy:
/*
<html>
<body>

<ul>
    {% for value in array %}
    <li> {{ value }}</li>
    {% endfor %}
</ul>

</body>
</html>
*/




/*
Zad 5:

    Stwórz szablon, który powinien wyświetlić artykuł.
    Klasę artykułu możesz znaleźć w katalogu z ćwiczeniami.
    Umieść go w folderze: /yourBundle/Entity (jeżeli go nie ma, to go stwórz). Pamiętaj o zmianie namespace na poprawny + dołączenia klasy Article do Twojego kontrolera:

    use <your_bundle>\Entity\Article;

    Następnie dopisz akcję /showArticle/{id}, która wczyta artykuł o podanym id i go wyświetli.

ODP:

Klasa artykłu Article.php znajduje się w projekt_view -> src -> Entity -> Article.php
Jest tam między innymi kod:

private $id;
    private $title;
    private $articleText;

    public static function GetArticlebyId($id){
        if($id < 20){
            return new Article($id, "Title for article $id", "Text for article $id. Lorem ipsum...");
        }
        return null;
    }

    public static function GetAllArticles(){
        $ret = [];
        for($i=0; $i< 20; $i++){
            $ret[] = self::GetArticlebyId($i);
        }
        return $ret;
    }


W kontrolerze (viewsController.php):
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Article;

class viewsController extends Controller
{

    /**
     * @Route("/showArticle/{id}/")
     * @Template("Views/show_article.html.twig")
     */

    public function showArticleAction($id)
    {
        $article = Article::GetArticlebyId($id); //odwołanie się do publicznej funkcji statycznej GetArticlebyId z klasy Article
        //$article = new Article();
        //$article->GetArticlebyId($id);
        return ['article' => $article];

    }


    /**
     * @Route("/showAllArticles/")
     * @Template("Views/show_all_article.html.twig")
     */

    public function showAllArticleAction()
    {
        $articles = Article::GetAllArticles();
        return ['articles' => $articles];

    }


    /**
     * @Route("/showAllArticlesNice/")
     * @Template("Views/show_all_article_nice.html.twig")
     */

    public function showAllArticleNiceAction()
    {
        $articles = Article::GetAllArticles();
        return ['articles' => $articles];

    }
}

//I teraz w pliku show_article.html.twig
/*
<h1>{{ article.getTitle }}</h1>
<p> {{ article.getArticleText }}</p>
<p><i> {{ article.getId }}</i></p>
*/


//----------------


/*
Zad 6:

    Stwórz akcję /showAllArticles, która wyświetli wszystkie artykuły.
    Do wyświetlenia artykułu użyj szablonu z zadania 5 działu 2_Skladnia_twiga.
    Nie pisz wyświetlania od nowa, w pętli użyj wykonanego wcześniej szablonu.


ODP:

Z Zad 5 - w kontrolerze showAllArticleAction


Tak wygląda plik bazowy (superbase.html.twig):

<!DOCTYPE html>
<html>
<head>
<title>{%  block title  %}{%  endblock %}</title>
</head>
<body>
  {% block menu %}
     <nav>
      <!-- w konsoli dać php app/console debug:router i można sprawdzić jakie są akcje - dla nas bierzemy app_views_showallarticle -->
      <li><a href="{{ path('app_views_showallarticle') }}">
              {{ 'Pokaż wszystkie artykuły' | trans }}</a></li>
      <li><a href="{{ url('app_views_showarticle', {'id':'5'}) }}">Pokaż artykuł nr 5</a></li>
     </nav>
  {%  endblock %}

   <h1>{{ app.request.attributes.get("_controller") }}</h1> <!-- to z internetu - rozwiązuje problem kontrolera -->
   <div class="main_content">
       {%  block content %}{% endblock %}
   </div>
</body>

</html>



I teraz w pliku show_all_article.html.twig dajemy:

{%  extends"superbase.html.twig" %}

{%  block content %}
{%  for art in articles %}
  {{ include ("Views/show_article.html.twig", {'article':art}) }}
{%  endfor %}
{%  endblock %}


A plik show_articlehtml.twig wygląda tak:
<h1>{{ article.getTitle }}</h1>
<p> {{ article.getArticleText }}</p>
<p><i> {{ article.getId }}</i></p>

//----------------

Zad 7:
    Zmień główny szablon w taki sposób, żeby w menu wyświetlały się linki do wszystkich akcji z poprzednich zadań (pamiętaj o przekazaniu poprawnych slugów).
    Napisz menu dwa razy:
        używając path(),
        używając url().

Zobacz, czym się różnią wygenerowanie linki.


ODP:

Zmianiamy w pliku superbase.html.twig na taki:

<!DOCTYPE html>
<html>
<head>
<title>{%  block title  %}{%  endblock %}</title>
</head>
<body>
  {% block menu %}
     <nav>
      <!-- w konsoli dać php app/console debug:router i można sprawdzić jakie są akcje - dla nas bierzemy app_views_showallarticle -->
      <li><a href="{{ path('app_views_showallarticle') }}">Pokaż wszystkie artykuły</a></li>
      <li><a href="{{ url('app_views_showarticle', {'id':'5'}) }}">Pokaż artykuł nr 5</a></li>
     </nav>
  {%  endblock %}

   <h1>{{ app.request.attributes.get("_controller") }}</h1> <!-- to z internetu - rozwiązuje problem kontrolera -->
   <div class="main_content">
       {%  block content %}{% endblock %}
   </div>
</body>

</html>

w pliku show_all_article.html.twig

{%  extends"superbase.html.twig" %}

{%  block content %}
{%  for art in articles %}
  {{ include ("Views/show_article.html.twig", {'article':art}) }}
{%  endfor %}
{%  endblock %}

i uruchamiamy to wpisując w przeglądarce: http://localhost:8080/showAllArticles/

Różnica wygląda w formie linków:
<li><a href="/showAllArticles/">Pokaż wszystkie artykuły</a></li>  <- to jes path
<li><a href="http://localhost:8080/showArticle/5/">Pokaż artykuł nr 5</a></li>  <- to jest url



//--------------


Zad 8:
Tłumaczenia:

W app->config>config.yml odkomentujemy:
 #translator: { fallbacks: ['%locale%'] } - usuwamy "#" z przodu
 i w parameters:
         locale: en
zmieniamy na pl

Teraz tworzymy katalog "translations" w projekt_view->app->Resources
i tworzymy w nim plikk messages.pl.xlf, a w nim:

<?xml version="1.0"?>
<xliff version="1.2" xmlns="urn:oasis:names:tc:xliff:document:1.2">
 <file source-language="en" datatype="plaintext" original="file.ext">
 <body>
  <trans-unit id="1">
   <source>Pokaż wszystkie artykuły</source>
   <target>Show all articles</target>
  </trans-unit>
 </body>
 </file>
</xliff>

trzeba jeszcze w konsoli wyczyścić cache:
php app/console cache:clear

 */