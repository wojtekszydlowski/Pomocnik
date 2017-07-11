<?php
/*
TEORIA:


Doctrine - to zbiór	bibliotek w PHP skupiających się przede wszystkim na obsłudze różnych rodzajów baz danych oraz mapowaniu ich struktury na obiekty w PHP.

Oficjalna strona projektu: http://www.doctrine-project.org
Kod	projektu: http://github.com/doctrine

Doctrine nie jest integralną częścią Symfony. Samo Symfony nie ma żadnej warstwy obsługi baz danych, dopiero dystrybucja Symfony Standard Edition integruje się z Doctrine. Ten zbiór bibliotek możemy używać też w projektach, które nie korzystają	z Symfony.

Doctrine składa	się	przede wszystkim z dwóch kluczowych	elementów:
-DBAL (Database Abstraction	Layer) – warstwa abstrakcji	baz	danych, rozszerzająca funkcjonalności PDO (PHP Data	Objects),
-ORM (Object Relational	Mapper)	– warstwa mapowania	obiektów w PHP na strukturę	relacyjnych	baz	danych opartą na DBAL. ORM wprowadza dialekt DQL alternatywny wobec	SQL.

Doctrine składa	się	także m.in.	z:
-Migrations	– narzędzia	służące	do wersjonowania struktury baz danych,
-ODM (Object Document Mapper) – warstwa	mapowania obiektów na tzw. dokumentowe bazy	danych (NoSQL),	tj. MongoDB, CouchDB

--

Model i encja

We wzorcu projektowym model	jest klasą,	która reprezentuje nam tabelę z bazy danych.
Jeden obiekt tej klasy reprezentuje jeden wiersz w tej tabeli.
W Doctrine obiekty te są nazywane encjami.

Ideologicznie na jedną klasę modelu powinna	przypadać jedna	klasa kontrolera, nie jest błędem używanie w kontrolerze wielu modeli.	.
Zadaniem modelu	jest utrzymanie informacji i ich synchronizacja	z bazą danych.
Zadaniem kontrolera	jest korzystanie z modelu (wczytywanie,	wpisywanie nowych danych itp.).

Głównym zadaniem encji jest przenoszenie informacji. Zgodnie z MVC mogą one	także realizować proste	zadania	logiczne, np.:
-encja zamówienia może zwracać jego wartość	jako sumę cen poszczególnych elementów zamówienia,
-encja kupon rabatowy może sprawdzać, czy przysługuje on danemu użytkownikowi,


Namespace encji:
Encje –	tak	samo jak w przypadku modeli	– muszą	należeć	do swojego namespace.

Zawsze należy dodać	namespace na początku pliku	z encją	gdyż bez tego nasza encja nie będzie działać.

namespace Bundle_name\Entity;

Ta linia musi znajdować	się	na początku pliku z	encją. Oczywiście wpisujemy swojego	bundla.


--

Repozytoria
-Do	wczytywania	encji z	bazy danych potrzebujemy repozytorium.
-O repozytoriach można myśleć jak o obiektach, których zadaniem	jest pomoc w pobieraniu	encji (pojedynczych	lub	kolekcji) określonego typu z	bazy danych.
-Podstawowe	repozytorium jest zawsze dla nas dostępne.
-Oznacza to, że podstawowe metody związane z pobieraniem danych	są dla nas dostępne.


----------

PRACA Z ENCJĄ:

W pliku kontrolera trzeba podlinować encję komendą (wpisujemy swojego bundla i nazwę modelu):
use	My_Bundle\Entity\My_EntityClass;

--

ZAPISYWANIE NOWEJ ENCJI DO BAZY DANYCH:

public function	createAction()
{
 //tworzymy nowy obiekt naszego modelu w kontrolerze:
 $firstPost	= new Post();

 //Ustawiamy seterami odpowiednie wartości:
 $firstPost->setTitle('My first	post');
 $firstPost->setRaiting(6.4);
 $firstPost->setPostText('Lorem	ipsum dolor...');

 //wczytujemy obiekt klasy EntityManager – jest	to obiekt, który zarządza naszymi encjami (zapamiętuje je, wczytuje, itp.)
 $em=$this->getDoctrine()->getManager();

 //informujemy EntityManagera o naszym nowym obiekcie
 //Metoda persist() informuje Doctrine o naszej	nowej encji. Na	razie jednak nie jest ona zapamiętana w	bazie danych.
 $em->persist($firstPost);

 //Używamy metody flush na Menagerze:
 //Dopiero metoda flush() powoduje,	że Doctrine sprawdza stan wszystkich znanych sobie encji.
 //Jeżeli ten stan różni się od	tego, co jest w	bazie danych, to dane są dodawane lub aktualizowane.
 $em->flush();

 //I na końcu akcja	musi zwracać obiekt Response
 return	new	Response('New post - id: ' . $firstPost->getId());
}


---

WCZYTYWANIE ISTNIEJĄCYCH ENCJI:

Kiedy mamy już repozytorium	dla	naszych	encji, możemy wczytać obiekty naszej klasy z bazy danych. Pierwszym	krokiem	jest załadowanie	odpowiedniego	repozytorium:

public function	showPostAction()
{
 $em = $this->getDoctrine()->getManager();
 $repository = $em->getRepository('My_bundle:My_Entity');

 //Następnie możemy	użyć metod naszego podstawowego	repozytorium:
 $post = $repository->find($id);  //Wyszukuj po	kluczu głównym

 //Wyszukuj po danym	atrybucie (te metody są	tworzone dynamicznie dla każdego atrybutu):
 $post = $repository->findOneById($id);
 $post = $repository->findOneByTitle('foo');
 $post = $repository->findOneByRaiting(4.0);
 $post = $repository->findOneByPostText('Some text...');

 //Z repozytorium możemy wczytać wiele encji. Otrzymamy	wtedy tablicę z	tymi encjami.
 $allPosts = $repository->findAll(); //Znajdzie	nam	wszystkie encje. Wynik może być	bardzo długi.

 //Znajdzie	wszystkie encje	spełniające założenia dla danej	kolumny.
 $posts = $repository->findByRaiting(3.65);
 $posts	= $repository->findByTitle('foo');
 $posts	= $repository->findByPostText('Some	text...');

 //Wczytywanie encji po	wielu kolumnach:
 //Encje możemy	też	wczytywać po wielu kolumnach. Do metody	findBy musimy przekazać	wtedy tablicę, gdzie kluczem jest nazwa	kolumny, a	zawartością	szukana wartość.

 $post=$repository->findOneBy(['title' => 'foo', 'raiting' => 2.00]);
 $posts=$repository->findBy(['title'=>'foo','raiting'=>2.00]);



---

ZAPISYWANIE NOWEGO STANU ENCJI:
Zapisywanie już istniejącej	encji do bazy danych jest bardzo proste. Wystarczy wprowadzić zmiany do	encji, a następnie wywołać metodę	flush(). Encja wczytana	z bazy danych jest od razu zapamiętywana w EntityManagerze,	więc nie musimy	go informować o	jej	istnieniu.

$em=$this->getDoctrine()->getManager();
$post=$em->getRepository('MyBundle:Post')->find($id);
if (!$post) {
//	Sprawdzamy,	czy	post o podanym id istnieje...
}
$post->setTitle('Zmieniony	tytuł!');
$em->flush();

---

USUWANIE ENCJI:
Usunięcie encji	z bazy danych polega na wczytaniu jej, następnie użyciu	metody remove()	na obiekcie	EntityManager, a następnie	zapamiętaniu stanu	bazy danych poprzez	metodę flush().

$em=$this->getDoctrine()->getManager();
$post=$em->getRepository('MyBundle:Post')->find($id);

if (!$post)	{
//	Sprawdzamy,	czy	post o podanym id istnieje...
}
$em->remove($post);
$em->flush();

 */





//----------------------------------------------------------------

//ZADANIA:


/*
Zad 1:
1.Stwórz nowy projekt o nazwie project_model.
2.Wygeneruj nowy kontroler o nazwie Book za pomocą odpowiedniej komendy konsolowej.
3.Połącz Doctrine ze swoją bazą danych, a następnie stwórz nową bazę o nazwie book_exercises.

ODP:
1.Wchodzimy do katalogu, w którym ma powstać projekt (i katalog do niego) np. do WorkSpace, a następnie wpisujemy w konsoli:
symfony new project_model 2.8

Teraz trzeba urochomić serwer. Należy wejść do katalogu projektu a następnie wpisać w konsoli:
php app/console server:start 127.0.0.1:8080 - będziemy mieli to na porcie 8080 - tak skonfigorowane jest przec Coderslab
Po takim uruchomieniu serwera jeśli wejdzie się na stronę:
http://127.0.0.1:8080/ lub localhost:8080
pojawi się nam ekran "Welcome to Symfony...", gdzie na dole będzie już uruchomiony profiler

--
2.Musimy być w projekcie (katalogu) "project_model" i w konsoli wpisać:
php	app/console	generate:controller

i podajemy w poszczególnych krokach:
name: AppBundle:book
Routing format: annotation
Template format: twig
New action name: dajemy enter

Później w tak utworzonym kontrolerze (plik: project_model -> src -> AppBundle -> Controller - > bookController.php) należałoby wstawić:

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use	Symfony\Component\HttpFoundation\Response;
use	Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\EntityManager;
use	AppBundle\Entity\book\Book; //to można sprawdzić komendą w konsoli php app/console doctrine:mapping:info

class bookController extends Controller
{
...
}

--
3.Po utworzeniu nowego projektu project_model i stworzeniu kontrolera book idziemy do pliku:
project_model/app/config/parameters.yml
wyglądał on początkowo tak:

# This file is auto-generated during the composer install
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: symfony
    database_user: root
    database_password: null
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: 8c8ca23e01f6e8523db17d1def60517c68a2b455


Teraz zmieniamy na w pliku parameters.yml na:

# This file is auto-generated during the composer install
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: book_exercises
    database_user: root
    database_password: coderslab
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: 8c8ca23e01f6e8523db17d1def60517c68a2b455

i wtedy w konsoli wpisujemy:
php app/console doctrine:database:create

utworzy nam bazę danych "book_exercises"

jakbyśmy chcieli usunąć bazę danych to w konsoli należy wpisać:
php	app/console	doctrine:database:drop	--force


-------

Zad 2:
Wygeneruj model Book, który powinien mieć następujące dane:
    id,
    title,
    description,
    rating (float),
Wygeneruj odpowiednią tabelę w bazie danych, użyj komend konsolowych.

ODP:
W konsoli wpisujemy:
php app/console doctrine:generate:entity

i wtedy po kolei wpisujemy:
The entity shortcut name: AppBundle:book/Book
dalej: annotation
i podajemy poszczególne nazwy kolum w tabeli:
-id (tego nie musimy dodawać, bo to domyślnie doda)
-title (jako string)
-description (jako text)
-rating (jako float)

i trzeba wtedy w kosnsoli wpisujemy:
php app/console doctrine:schema:update --force
wygeneruje nam wtedy tabelę z tymi polami w bazie danych



-----------

Zad 3:
1. Stwórz akcję /newBook, która ma wyświetlać formularz do tworzenia nowej książki. Formularz, póki co, napisz w normalnym HTML.    Formularz ma kierować do akcji /createBook
2.Stwórz akcję /createBook. Akcja ta ma pobierać informacje z POST i na jej podstawie tworzyć i zapamiętywać do bazy danych nową książkę. Na razie powinna wyświetlać statyczną informację o tym, że udało się stworzyć książkę (co zweryfikuj za pomocą PHPMyAdmin)
3. Stwórz akcję /showBook/{id}, która ma pobierać książkę o podanym id z bazy danych i wyświetlać jej informację na stronie. Zmodyfikuj akcję /createBook tak żeby po stworzeniu nowej książki przekierowywała do akcji /showBook dla nowo dodanej książki
4.Stwórz akcję podpiętą do adresu /showAllBooks.  Powinna ona wczytać wszystkie książki i wyświetlić ich tytuły.  Przy każdej książce powinien być link do wyświetlenia pełnej informacji o niej
5.Stwórz akcję podpiętą do adresu /deleteBook/{id}. Powinna ona usuwać książkę o podanym id i wyświetlać komunikat o usunięciu.



ODP:

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use	Symfony\Component\HttpFoundation\Response;
use	Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\EntityManager;
use	AppBundle\Entity\book\Book; //to można sprawdzić komendą w konsoli php app/console doctrine:mapping:info



//Pkt.1:
*/

class bookController extends Controller
{
    /**
     * @Route("/newBook/")
     */
    public function newBookAction()
    {
        return $this->render('form.html');
    }

    //lub - inne rozwiązanie (zamienne):

    /**
     * @Route("/newBook/")
     * @Template("Book/create_book.html.twig")
     */
    public function newBookAction() {
        return [];
    }

//Pkt.2:

    /**
     * @Route("/createBook/")
     * @Method("POST")
     */
    public function createBookAction(Request $request)
    {
        $title = $request->request->get('title');
        $description = $request->request->get('description');
        $rating = $request->request->get('rating');

        //Można zmiennym nadawać wartości domyślne:
        //$mybook = new Book();
        //$mybook->setTitle($request->request->get('title','?'));
        //$mybook->setRating($request->request->get('rating',0));
        //$mybook->setDescription($request->request->get('description',''));

        $postToAdd = new Book();
        $postToAdd->setTitle($title);
        $postToAdd->setDescription($description);
        $postToAdd->setRating($rating);


        $em = $this->getDoctrine()->getManager();
        $em->persist($postToAdd);
        $em->flush();

        //return new Response("Dodano nowy posy o id:" . $postToAdd->getId());
        return $this->redirectToRoute('app_book_showbook', array('id' => $postToAdd->getID()));

    }

//Pkt.3:

    /**
     * @Route("/showBook/{id}/")
     */
    public function showBookAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:book\Book'); //$repository=$em->getRepository('My_bundle:My_Entity');Entity to encja
        $post = $repository->find($id);
        //var_dump($post);

        return new Response("Post w bazie o id $id to:<br>Tytuł: ". $post->getTitle() . "<br>Opis: ". $post->getDescription() . "<br>Ocena: " . $post->getRating() . "<br><br>");



    }

    //A tak zrobiony był przykład na zajęciach
    /**
     * @Route("/showBook/{id}")
     * @Template("Book/show_book.html.twig")
     */
    public function showBookAction($id) {
        $em = $this->getDoctrine()->getManager();
        $bookRepo = $em->getRepository('AppBundle:Book\Book');
        //$mybook = $bookRepo->getById($id);
        $mybook	= $bookRepo->findOneById($id);
        return ['book' => $mybook];
    }


//Pkt.4:

    /**
     * @Route("/showAllBooks/")
     */

    public function showAllBooksAction()
    {
        $em=$this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:book\Book');
        $allBooks = $repository->findAll();

        //var_dump($allBooks);

        $showResult = "";
        foreach ($allBooks as $oneLine)
        {
            $BookId = $oneLine->getId();
            $BookTitle = $oneLine->getTitle();
            $showResult .= "<a href='/showBook/$BookId/'>$BookTitle</a><br>";
        }

        return new Response ($showResult);


    }

    //lub inne rozwiązanie:

    /**
     * @Route("/showAllBooks/")
     * @Template("Book/show_all_books.html.twig")
     */
    public function showAllBooksAction() {
        $books = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Book\Book')
            ->findAll();

        return ['books' => $books];
    }

//Pkt.5:

    /**
     * @Route("/deleteBook/{id}/")
     */

    public function deleteBookAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $postToDelete = $em->getRepository('AppBundle:book\Book')->find($id);


        $message = "";
        if (!$postToDelete) {$message = "Nie ma takiej książki o zadanym id<br>";}
        else {
            $message = "Usunięto książkę<br>";
            $em->remove($postToDelete);
            $em->flush();

        }


        return new Response ($message);

    }


}

//A to pliki html.twig do tego zadania:
/*

delete_book.html.twig:

{% block content %}
<h2>{{ 'Książka zostałą usunięta' | trans }} </h2>
{% endblock %}

------------------------
form.html.twig:

{% block content %}
<h2>{{ 'Dodaj nową książkę' | trans }} </h2>
<form method="POST" action="{{ path('app_book_createbook') }}">
    <table>
        <tr>
            <th>{{ 'Tytuł'| trans }}:</th>
            <td><input type="text" name="title" /></td>
        </tr>
        <tr>
            <th>{{ 'Ocena'| trans }}:</th>
            <td><input type="decimal" name="rating" /></td>
        </tr>
        <tr>
            <th>{{ 'Opis'| trans }}:</th>
            <td><textarea name="description"></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" /></td>
        </tr>
    </table>
</form>
{% endblock %}

----------------
show_all_books.html.twig:

{% block content %}
<h2>{{ 'Wszystkie książki ' | trans }} </h2>

{% for book in books %}
    <ul>
        <li>
            <div>
                <a href="{{ path('app_book_showbook', {id:book.id}) }}">{{'tytuł: '}}{{book.title}}{{", id: "}}{{ book.id}}</a>
            </div>
            <div>
                <a href="{{ path('app_book_deletebook', {id:book.id}) }}">{{ 'usuń' }}</a>
            </div>
        </li>
    </ul>
{% endfor %}
{% endblock %}

----------------------

show_book.html.twig:

{% block content %}
<h2>{{ 'Podgląd książki ID' | trans }}: {{ book.id }}</h2>
<table>
	<tr><th>{{ 'Tytuł' | trans}}:</th>
		<td>{{ book.title }}</td>
	</tr>
	<tr><th>{{ 'Ocena' | trans}}:</th>
		<td>{{ book.rating }}</td>
	</tr>
	<tr><th>{{ 'Opis' | trans}}:</th>
		<td>{{ book.description }}</td>
	</tr>
</table>
{% endblock %}

*/
