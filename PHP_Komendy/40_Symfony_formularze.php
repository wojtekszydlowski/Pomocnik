<?php
/*

TEORIA:

Pełen spis typów pól: http://symfony.com/doc/2.8/reference/forms/types.html
Więcej o formularzach: http://symfony.com/doc/2.8/book/forms.html


KOMPONENT FORM:

Jedną z	głównych części	frameworku Symfony jest	komponent Form służący do budowy i obsługi formularzy.
Tak	jak	inne komponenty	jest niezależny	i może być wykorzystywany poza Symfony.
Komponent Form ma wbudowane następujące	metody:
-obsługę requestów HTTP wraz z uploadem	plików,
-ochronę formularzy	przed atakami CSRF,
-integrację z komponentem Templating,
-integrację	z komponentem Validator,
-integrację	z komponentem Translation.

Obiekt formularza można zbudować bezpośrednio w	kontrolerze lub zdefiniować	jako klasę.
Formularze powiązane są	z modelami danych (np. encjami)	lub	tablicami.
Dane z formularza mapowane są na obiekty lub na	tablice	asocjacyjne.

Budowa formularza składa się z trzech części:
-stworzenie	obiektu	klasy FormBuilder dla danej	klasy encji,
-dodanie do	obiektu	FormBuilder	pól, jakie mają być	w formularzu (i połączenie ich z atrybutami	encji),
-dodanie metody	i akcji	(opcjonalne), stworzenie formularza.


--

BUDOWA FORMULARZY W KONTROLERZE:

Aby stworzyć obiekt	klasy FormBuilder dla danej	encji musimy użyć metody createFormBuilder(), którą dziedziczymy z podstawowej klasy kontrolera.
Metodzie musimy	przekazać obiekt naszej	encji (nowy	lub	wczytany z bazy danych).

$post = new	Post();
$form = $this->createFormBuilder($post);

Opcjonalnie	możemy dodać metodę	i akcję naszego	formularza.	Jeżeli tego	nie zrobimy, to	domyślnie:
-metoda	nastawiona jest	na POST,
-akcja nastawiona jest na akcję, która stworzyła formularz.

$post = new Post();
$form =	$this->createFormBuilder($post)
			 ->setAction($this->generateUrl('target_route'))
			 ->setMethod('GET');

Następnie musimy dodać poszczególne pola naszego formularza	za pomocą metody add() wywoływanej na obiekcie FormBuilder.

$post =	new	Post();
$form =	$this->createFormBuilder($post)
			 ->setAction($this->generateUrl('target_route'))
			 ->setMethod('GET');
			 ->add('title', 'text')
			 ->add('postText', 'text')
			 ->add('save', 'submit', ['label' => 'Create post']);
             ->getForm();

Nazwa pola (np. title, postText) musi być taka sama jak nazwa atrybutu w naszej encji (poza submit).
Na koniec musimy wywołać getForm() na obiekcie FormBuilder. Sam FormBuilder	nie	będzie nam już potrzebny.

-

PRZEKAZYWANIE FORMULARZA DO WIDOKU:
Następnie musimy przekazać formularz do	widoku. Do widoku nie przekazujemy obiektu Form, tylko jego	widok, który otrzymujemy dzięki metodzie createView().

return $this->render('default/new.html.twig', ['form' => $form->createView()]);

-

WYŚWIETLANIE FORMULARZA W WIDOKU:

{{ form_start(form) }}
{{ form_widget(form) }}
{{ form_end(form) }}

-

PRZECHWYTYWANIE DANYCH Z FORMULARZA:
-Następnie musimy napisać kod, który przechwyci	dane z formularza wypełnionego przez użytkownika.
-Musimy stworzyć taki sam formularz, jakiego przedtem użyliśmy (dlatego dobrze jest	przenieść tworzenie formularza do osobnej metody).

Po stworzeniu formularza musimy przekazać mu obiekt	Request. Formularz sam wyjmie z	niego dane,	a następnie	uzupełni o nie obiekt encji.
Częstym	podejściem jest	tworzenie jednej akcji do wyświetlenia formularza i przetwarzania go. Żeby dowiedzieć się, czy formularz został wysłany, używamy metody isSubmitted().

$form = $this->createFormBuilder()
//.....
->getForm();

$form->handleRequest($request);
if	($form->isSubmitted())	{
    $post = $form->getData();  //Uzupełnienie obiektu encji
    $em = $this->getDoctrine()->getManager();
    $em->persist($post);
    $em->flush();

    return $this->redirectToRoute('task_success');
}

---

ŁĄCZENIE FORMULARZY Z ENCJĄ:
Całą potęgą	formularzy w Symfony jest automatyczne połączenie formularza z naszą encją. Dzieje się to dzięki temu, że formularz szuka z naszej encji:
-publicznego atrybutu z	taką samą nazwą	jak	jego pole,
-publicznej	metody set odpowiadającej nazwie pola.

Metoda add:
Metoda add() tworzy	nam	pole w formularzu. Musimy jej przekazać	następujące	dane:
-nazwę pola	(taka sama jak atrybut,	do którego odnosi się to pole),
-typ pola,
-tablicę z dodatkowymi opcjami.

Typy pól:
W Symfony możemy skorzystać	m.in. z następujących typów	pól:
-pola tekstowe,
-pola wyboru,
-przycisk,
-pola ukryte.

Pełen spis typów pól: http://symfony.com/doc/2.8/reference/forms/types.html


Opcje przekazywania	do add():
Do metody add() możemy przekazywać różne opcje (w formie tablicy podawanej jako trzeci parametr). Opcje	te różnią się w	zależności od typu pola. Opcje przyjmowane przez	dany typ pola można	znaleźć	w dokumentacji.
Jednymi	z najczęściej używanych opcji są:
-required –	określa, czy pole formularza jest wymagane (przyjmuje wartości true	albo false),
-label – dodaje	opis do	pola formularza.

->add('dueDate', 'date',	[
			'required' => true,
			'label' => 'Due Date',
]);


TYP POLA - ENTITY:
Jednym z najważniejszych typów pól jest	pole wyboru	encji. Pozwala nam ono na wybranie jednej z encji danej	klasy, która jest zapisana	w bazie danych.
Na stronie wyświetla się jako pole wyboru.

Jeżeli wybraliśmy typ pola entity, musimy przekazać	do formularza co najmniej dwie opcje:
-class – nazwa klasy encji budowaną na zasadzie	BundleName:EntityName
-choice_label – nazwa atrybutu,	który będzie używany do wyświetlenia w formularzu.


->add('users', 'entity', [
	  'class' => 'myBundle:Tag',
	  'choice_label' =>	'tagName',
]);

Jeżeli chcemy, żeby nasz formularz wczytywał tylko wybrane encje danej klasy, możemy przekazać mu odpowiednie zapytanie	DQL. Robimy	to przez użycie opcji query_builder

Więcej o tej opcji można przeczytać	tutaj:
http://symfony.com/doc/2.8/reference/forms/types/entity.html#using-a-custom-query-for-the-entities

--

ZAAWANSOWANE RENDEROWANIE:

Możemy też wpłynąć na to, jak nasz formularz jest renderowany. Możemy wyświetlać po	kolei każde	jego pole. Służą do tego odpowiednie metody	Twig:
-form_start(),
-form_label(),
-form_widget(),
-form_end().

{{ form_start(form) }}
	<div>
	  {{ form_label(form.task) }}
	  {{ form_widget(form.task) }}
	</div>
	<div>
      {{ form_label(form.dueDate) }}
	  {{ form_widget(form.dueDate) }}
	</div>
	<div>
      {{ form_widget(form.save) }}
	</div>
{{ form_end(form)	}}


Więcej o formularzach: http://symfony.com/doc/2.8/book/forms.html
M.in. o:
-nadpisywaniu szablonów	formularzy,
-tworzeniu specjalnych klas	formularzy,
-tworzeniu formularzy pod wiele	encji,
-używaniu formularzy bez klasy encji.



//---------------------------


ZADANIA:

Zad. 1:

1.Stwórz nowy projekt o nazwie projekt_form. Następnie wszystkie zadania rozwiązuj w domyślnym bundlu AppBundle
2.Wygeneruj model Tweet, który ma zawierać: id, nazwę, tekst.
  Wygeneruj dla niego Kontroler z następującymi akcjami: create, new, showAll.
  Póki co napisz akcję showAll, która wyświetli tytuły wszystkich Tweetów w bazie danych.
3.Napisz dla Tweeta następujące akcje:
  -new, która ma wyświetlać formularz,
  -create, która ma na podstawie formularza tworzyć nową encję i zapisywać do bazy danych.
4.Dopisz akcję /update/{id}. Jeżeli wejdziemy na nią metodą GET, to ma wczytać Tweet o podanym id i następnie wyświetlić do niego formularz do edycji. Jeżeli wejdziemy na nią metodą POST, to powinna zapamiętać wysłane informacje do bazy danych.



ODP:

TweetController.php:
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tweet\Tweet;

class TweetController extends Controller
{
    /**
     * @Route("/showAllTweets/")
     * @Template("Tweet/show_all_tweets.html.twig")
     */
    public function showAllAction() {
        $tweets = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Tweet\Tweet')
            ->findAll();

        return ['tweets' => $tweets];
    }

    /**
     * @Route("/newTweet/")
     * @Template("Tweet/tweet_form.html.twig")
     */
    public function newAction() {
        $tweet = new Tweet();

        $form = $this->createFormBuilder($tweet)
            ->setAction($this->generateUrl('app_tweet_create'))
            ->add('name', 'text')
            ->add('description', 'text')
            ->add('save', 'submit', ['label' => 'Dodaj nowego tweeta'])
            ->getForm();


        return ['form' => $form->createView(), 'is_updated' => false];
    }

    /**
     * @Route("/createTweet/")
     * @Template("Tweet/create_tweet.html.twig")
     * @Method({"POST","GET"})
     */
    public function createAction(Request $request) {
        $tweet = new Tweet();

        $form = $this->createFormBuilder($tweet)
            ->add('name', 'text')
            ->add('description', 'text')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $tweet = $form->getData();

            $em	   = $this->getDoctrine()->getManager();
            $em->persist($tweet);
            $em->flush();

            return ['result' => true];
        }

        return ['result' => false];
    }

    /**
     * @Route("/updateTweet/{id}")
     * @Template("Tweet/tweet_form.html.twig")
     * @Method({"POST","GET"})
     */
    public function updateAction(Request $request, $id) {
        $is_updated = false;

        $em			= $this->getDoctrine()->getManager();
        $tweetRepo	= $em->getRepository('AppBundle:Tweet\Tweet');
        $tweet		= $tweetRepo->findOneById($id);

        if (! $tweet) {
            return $this->redirectToRoute('app_tweet_new');
        }

        $form = $this->createFormBuilder($tweet)
            ->setAction($this->generateUrl('app_tweet_update', ['id'=>$id]))
            ->add('name', 'text')
            ->add('description', 'text')
            ->add('save', 'submit', ['label' => 'Zapisz tweeta'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $tweet = $form->getData();
            $em	   = $this->getDoctrine()->getManager();
            $em->persist($tweet);
            $em->flush();

            $is_updated = true;
        }

        return ['form'=>$form->createView(), 'is_updated' => $is_updated];

    }
}

/*
//I teraz poszczególne pliki twiga:

//show_all_tweets.html.twig:

    {% for tw in tweets %}
<h2>{{ tw.name }} (ID: {{ tw.id }})</h2>
	<pre>{{ tw.description }}</pre>
	<a href="{{ path('app_tweet_update', {'id': tw.id}) }}">[edycja]</a>
	<hr/>
{% else %}
	<i>W bazie nie ma żadnych tweetów.</i>
{% endfor %}



//tweet_form.html.twig:

<h2>Formularz tweeta</h2>
<div class="nice_class">
	{{ form_start(form) }}
	{{ form_widget(form) }}
	{{ form_end(form) }}
</div>

{% if is_updated %}
	<i>Tweet został zaktualizowany!</i>
{% endif %}



//create_tweet.html.twig:

{% if result %}
	<i>Formularz przesłany i obsłużony!</i>
{% else %}
	<i>Nie przesłano formularza.</i>
{% endif %}

<hr>
<a href="{{ path('app_tweet_showall') }}">Wszystkie tweety</a>