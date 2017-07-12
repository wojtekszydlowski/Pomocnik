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



-------


RELACJE:

1.Wiele do jednego,	jednokierunkowa:
Jest to relacja, w której:
-encja A wie o jednej przypisanej do siebie encji B,
-encja B nie wie nic o encjach A (może być przypisana do wielu).
Użytkownik wie,	jaki ma	adres, ale adres nie ma	informacji o przypisanych do siebie użytkownikach.

/**	@ORM\Entity	*/
class	User{  //Encja	User
    /**
     *	@ORM\ManyToOne(targetEntity="Address") //Wskazanie	na	relację	z	encją	Address
     *	@ORM\JoinColumn(name="address_id",	referencedColumnName="id")
     */
    private	$address;
}

class	Address{
    /*	...	*/
}

/*
--
Opis:
-class	User{  ->Encja	User
-@ORM\ManyToOne(targetEntity="Address") ->Wskazanie	na	relację	z	encją	Address
-@ORM\JoinColumn(name="address_id",	referencedColumnName="id") ->Wskazanie na relację kolumny address_id z encji User z	kolumną id z encji Address


---

2.Jeden do wielu, dwukierunkowa:
Jest to relacja, w której:
-encja A ma wiele encji B,
-encja B może mieć tylko jedną encje A.
-obie encje wiedzą o sobie.
Jest to	na przykład produkt w sklepie internetowym i opinie o nim.
Produkt	może mieć wiele opinii, ale opinia należy tylko	do jednego produktu.
*/

class Product{
	/**
	* @ORM\OneToMany(targetEntity="Review", mappedBy="product")
	*/
private	$reviews;

public function __construct() {
    $this->reviews = new ArrayCollection();
   }
}

class Review{
     /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="reviews")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private	$product;
}

/*
Jeśli trzymamy relacje do wielu innych obiektów, to musimy specjalnie zainicjalizować atrybut naszej encji. Atrybut, który będzie trzymał wiele encji, musi być obiektem klasyArrayCollection. Musimy zatem pamiętać o podlinkowaniu obiektu ArrayCollection:

use	Doctrine\Common\Collections\ArrayCollection;


---

3.Jeden do jednego, dwukierunkowa:
W tej relacji obie encje wiedzą	o sobie	wzajemnie. Na przykład użytkownik wie o swoim koszyku, koszyk wie, do kogo jest przypisany.
*/

class Customer{
	/**
	* @ORM\OneToOne(targetEntity="Cart", mappedBy="customer")
	*/

	private $cart;
}

class	Cart{
    /**
     * @ORM\OneToOne(targetEntity="Customer", inversedBy="cart")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;
}

/*
----

4.Wiele do wielu, dwukierunkowa:
W tej relacji encja A wie o wielu encjach B, a encja B wie o wielu encjach A.
Na przykład użytkownik może być w wielu grupach, a grupa ma wielu użytkowników.
*/

class User{
		/**
		* @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
		* @ORM\JoinTable(name="users_groups")
		*/

		private $groups;

    public function	__construct() {
    $this->groups = new ArrayCollection();
    }
}

class Group{
     /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
     */

     private $users;

     public function __construct()	{
        $this->users = new ArrayCollection();
    }
}

/*
-------

Wczytywanie połączonych encji:
Wczytanie połączonej encji jest niezwykle proste. Wystarczy	odwołać	się	do atrybutu, który oznaczyliśmy	relacją, i otrzymujemy podłączoną	encję (lub tablicę encji):

$em = $this->getDoctrine()->getManager();
$customer = $em->getRepository('myBundle:Customer')->find($id);
$cart = $customer->getCart();  //Mamy encje koszyka

--

Nastawianie	relacji:
Aby ustawić relację	pomiędzy encjami, wystarczy	wstawić	encję odpowiedniej klasy do	atrybutu i zapamiętać stan bazy danych.

$customer->setCart($cart);
$em=$this->getDoctrine()->getManager();
$em->persist($cart);
$em->persist($customer);
$em->flush();


------------

DOCTRINE QUERY LANGUAGE (DQL)

Jeśli chcemy znaleźć naszą encję na podstawie bardziej rozbudowanego zapytania,	to możemy skorzystać z DQL.
DQL jest językiem zapytań podobnym do SQL. W DQL nie myślimy w kategoriach bazy danych i jej tabel,	a w	kategoriach obiektów i ich klas. Dla osób znających	SQL	język DQL powinien być od razu zrozumiały.

Zamiast	kolumn wybieramy cały obiekt, a	zamiast	tabeli - przeszukujemy naszą klasę.
#SQL:
SELECT * FROM Posts	WHERE raiting > 5;
#DQL:
SELECT post	FROM myBundle:Post post	WHERE post.raiting > 5

#SQL:
SELECT * FROM products WHERE price > 300.00	ORDER BY price DESC;
#DQL:
SELECT p FROM myBundle:Product p WHERE p.price > 300.00	ORDER BY p.price DESC


Przygotowywanie	zapytań	DQL:
Zapytania przygotowujemy, używając obiektu EntityManagera i	jego metody createQuery(). Tworzymy	wtedy obiekt zapytania.

$em=$this->getDoctrine()->getManager();
$query = $em->createQuery(
'SELECT	p
FROM myBundle:Product p
WHERE p.price >	300.00
ORDER BY p.price DESC'
);


Jeżeli chcemy dynamicznie nastawiać wartość, według	której będziemy wyszukiwać,	możemy przekazać do zapytania zmienną.
$em=$this->getDoctrine()->getManager();
$query = $em->createQuery(
'SELECT	p
FROM myBundle:Product p
WHERE p.price > :priceToLook
ORDER BY p.price DESC'
)->setParameter('priceToLook', $somePrice);

Jeśli przygotowaliśmy zapytanie, to możemy go użyć.
Metoda ta zwraca nam tabelkę z wynikami (może być pusta!).
W przypadku	gdy	chcemy usunąć encję	z użyciem DQL użyjemy metody, która	zwróci odpowiedź true/false.

$products=$query->getResult(); //Metody	getResult()	używamy, gdy nie przekazujemy zmiennych do zapytania
$products=$query->execute(['priceToLook',$somePrice]); //Metody	execute() używamy, gdy przekazujemy	zmienne	do zapytania.

--

Określanie limitu zwracanych danych:
Jeżeli chcemy nastawić limit na	liczbę zwracanych danych, to możemy	użyć metody	setMaxResults(n) na	naszym zapytaniu:
$products =	$query->setMaxResults(20)->getResult();

Jeżeli chcemy, żeby	zapytanie zwróciło nam tylko jeden wynik zamiast tablicy wyników, powinniśmy wykonać dwa kroki:
-nastawić limit	na 1,
-zamiast getResult() użyć getOneOrNullResult()

$product = $query->setMaxResults(1)->getOneOrNullResult();

--

Zwracanie wyników:
Jeżeli chcemy otrzymać wyniki np. pomiędzy 20, a 30	(przydatne przy paginacji) możemy użyć klauzuli	BETWEEN	... AND ...

$query=$em->createQuery(
'SELECT	u
FROM myBundle:User u
BETWEEN	:start	AND	:stop'
);
$query->setParameter("start", 20);
$query->setParameter("stop", 30);
$users=	$query->getResult();

--

Klasa repozytorium:
Nasza klasa powinna spełniać następujące warunki:
-znajdować się w tym samym namespace co	nasza encja,
-nazywać się tak samo jak encja	z dodatkiem	Repository.
-repozytoria muszą dziedziczyć z klasy EntityRepository.
-powinny znajdować się w tym samym katalogu	co encja
-wyjątkiem są repozytoria wygenerowane automatycznie z użyciem poleceń konsolowych

Przykładowa klasa repozytorium:
namespace AppBundle\Entity;
use	Doctrine\ORM\EntityRepository;

class	PostRepository	extends	EntityRepository	{
				//....
}

Encje z ich	repozytoriami wiążemy przez	adnotacje:
/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PostRepository")
 */
class	Product{
 //....
}

/*

Repozytorium najłatwiej	stworzyć przez automatyczne	wygenerowanie komendą konsolową:

doctrine:generate:entities

Komenda	ta również automatycznie generuje nam repozytorium,	które znajduje się w katalogu Repository
W klasie naszego repozytorium tworzymy metody, dzięki którym możemy	wczytywać encje, używając bardziej skomplikowanych zapytań.
Później	będziemy mogli z tych metod korzystać w	naszym kontrolerze tak samo, jak z podstawowych metod repozytorium.


Klasa repozytorium:

public function	findOrderedByRaiting($start, $stop){
 $em = $this->getDoctrine()->getEntityManager();
 $posts	= $em->createQuery(
	    'SELECT p FROM MyBundle:Post p
        ORDER BY p.raiting DESC
	    BETWEEN :start AND :stop')
 ->setParameter("start",	$start)
 ->setParameter("stop",	$stop)
 ->getResult();

return $posts;
}


Kontroler:

$em = $this->getDoctrine()->getManager();
$posts = $em->getRepository('MyBundle:Post')->findOrderedByRaiting(40, 50);

Zastosowanie metody	z repozytorium pozwala tworzyć nam swego rodzaju "aliasy" do bardziej skomplikowanych zapytań.



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





//--------------------------------

/*
Zad 4 - Relacje:
Rozwiązania: w katalogu Dzien_3 -> Model_i_Doctrine -> projekt_model_wykladowca

1.Stwórz model i kontroler dla autora. Model powinien mieć następujące informację: Id, Imię i nazwisko, Opis.
Kontroler powinien umożliwiać: tworzenie nowego autora w systemie, wyświetlenia autora, wyświetlenia wszystkich autorów.

2.Połącz autora i książkę relacją jeden do wielu (dwukierunkowa). Pamiętaj o ponownym wygenerowaniu bazy danych, setterów, getterów do obu klas za pomocą odpowiednich komend konsolowych.

3.Zmodyfikuj tworzenie książki, tak żeby użytkownik mógł wybrać jej autora. W tym celu w kontrolerze wczytaj wszystkich autorów i podaj ich do widoku. W widoku w pętli dodaj ich wszystkich do elementu select.

4.Zmodyfikuj wyświetlania zarówno książki, jak i autora. Książka powinna pokazywać dane swojego autora (imię i nazwisko) i podawać link do jego strony. Autor powinien wypisywać, ile ma książek. Następnie w liście pokazywać ich nazwy i linki do stron książek.


 */


//Pkt.1:
/*
AppBundle:author/Author
id pomijamy i dodajemy 2 pola: name i description
Jak nie stworzy pliku authorController.php to ręcznie go stworzyć

Najpierw dodajemy te wszystkie strony do dodawania/usuwania/pokazywania autora:
*/

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use	Symfony\Component\HttpFoundation\Response;
use	Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\ORM\EntityManager;
use	AppBundle\Entity\author\Author; //to można sprawdzić komendą w konsoli php app/console doctrine:mapping:info

class authorController extends Controller
{

    /**
     * @Route("/newAuthor/")
     * @Template("form_author.html.twig")
     */
    public function newAuthorAction() {
        return [];
    }


    /**
     * @Route("/createAuthor/")
     * @Method("POST")
     */
    public function createAuthorAction(Request $request) {

        $myauthor = new Author();
        $myauthor->setName($request->request->get('name','?'));
        $myauthor->setDescription($request->request->get('description',''));

        $em = $this->getDoctrine()->getManager();
        $em->persist($myauthor);
        $em->flush();


        return $this->redirectToRoute('app_author_showauthor',
            array( 'id' => $myauthor->getId() ));
    }


    /**
     * @Route("/showAuthor/{id}")
     * @Template("show_author.html.twig")
     */
    public function showAuthorAction($id) {
        $em 		= $this->getDoctrine()->getManager();
        $authorRepo	= $em->getRepository('AppBundle:author\Author');
        //$mybook		= $bookRepo->getById($id);
        $myauthor		= $authorRepo->findOneById($id);
        return ['author' => $myauthor];
    }


    /**
     * @Route("/showAllAuthors/")
     * @Template("show_all_authors.html.twig")
     */
    public function showAllAuthorsAction() {
        $authors = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:author\Author')
            ->findAll();

        return ['authors' => $authors];
    }


    /**
     * @Route("/deleteAuthor/{id}")
     * @Template("delete_author.html.twig")
     */
    public function deleteAuthorAction($id) {
        $em = $this->getDoctrine()->getManager();
        $authorRepo = $em->getRepository('AppBundle:author\Author');
        //$mybook = $bookRepo->getById($id);
        $myauthor = $authorRepo->findOneById($id);

        if(!$myauthor){
            return new Response ("<html><body>Nie znaleziono autora o podanym id :(</body></html>");
        }

        $em->remove($myauthor);
        $em->flush();
        return [];
    }


}

//--

//Pkt.2:
/*
I teraz w musimy pozmieniać w plikach (encjach) Author.php i Book.php - tam trzeba ustawić relację:
project_model->src->AppBundle->Entity->author->Author.php

Jedna książka ma tylko jednego autora, autor może być autorem wielu książek -> relacja jeden do wielu dwukierunkowa


W Book.php dodaliśmy (w klasie "class Book {..."):

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Author\Author", inversedBy="books")
     * @ORM\JoinColumn(name="author_id",  referencedColumnName="id")
     */
     private $author;

/*

W Author.php:

     /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Book\Book", mappedBy="author")
     */
     private $books;
/*

Na końcu w konsoli trzeba wykonać jeszcze:

php app/console doctrine:generate:entities AppBundle
php app/console cache:clear
php app/console doctrine:schema:update --force

 */


//Pkt.3:
/*

//plik create_book.html.twig:

<h2>{{ 'Dodaj nową książkę' | trans }}</h2>
<form method="POST" action="{{ path('app_book_createbook') }}">
	<table>
		<tr><th>{{ 'Tytuł' | trans}}:</th>
			<td><input type="text" name="title" /></td>
		</tr>
		<tr><th>{{ 'Autor' | trans}}:</th>
			<td>
				<select name="author">
				{% for a in authors %}
					<option value="{{ a.id }}">{{ a.name }}</option>
				{% endfor %}
				</select>
			</td>
		</tr>
		<tr><th>{{ 'Ocena' | trans}}:</th>
			<td><input type="decimal" name="rating" /></td>
		</tr>
		<tr><th>{{ 'Opis' | trans}}:</th>
			<td><textarea name="description"></textarea></td>
		</tr>
		<tr><td colspan="2"><input type="submit" /></td></tr>
	</table>
</form>

W bookController.php dajemy:
*/
	/**
	 * @Route("/newBook/")
	 * @Template("Book/create_book.html.twig")
	 */
    public function newBookAction() {
    $authors = $this->getDoctrine()->getManager()
        ->getRepository('AppBundle:Author\Author')
        ->findAll();

    return ['authors' => $authors];
    }

//---------

//Pkt.4:

/*

show_book_html.twig:

<h2>{{ 'Podgląd książki ID' | trans }}: {{ book.id }}</h2>
<table>
	<tr><th>{{ 'Tytuł' | trans}}:</th>
		<td>{{ book.title }}</td>
	</tr>
	<tr><th>{{ 'Autor' | trans}}:</th>
		<td>
			<a href="{{ path('app_author_showauthor', {'id': book.author.id}) }}">{{ book.author.name }}</a>
		</td>
	</tr>
	<tr><th>{{ 'Ocena' | trans}}:</th>
		<td>{{ book.rating }}</td>
	</tr>
	<tr><th>{{ 'Opis' | trans}}:</th>
		<td>{{ book.description }}</td>
	</tr>
</table>

--

show_author.html.twig:

<h2>{{ 'Podgląd autora ID' | trans }}: {{ author.id }}</h2>
<table>
	<tr><th>{{ 'Imię i nazwisko' | trans}}:</th>
		<td>{{ author.name }}</td>
	</tr>
	<tr><th>{{ 'Opis' | trans}}:</th>
		<td>{{ author.description }}</td>
	</tr>
	<tr><th>{{ 'Książki autora' | trans}}:</th>
		<td>
			<ol>
			{% for b in author.books %}
				<li><a href="{{ path('app_book_showbook', {'id': b.id}) }}">{{ b.title }}</a></li>
			{% else %}
				<i>Wg mnie ten autor nie napisał jeszcze żadnej książki..</i>
			{% endfor %}
			</ol>
		</td>
	</tr>
</table>



--------------------------


Zad. 5: DQL

Stwórz akcje, które pokażą następujące dane:
    Wszystkie książki oid większym niż podane przez użytkownika.
    Wszystkie książki o ratingu większym niż podany przez użytkownika.
    Pokażą wszystkie książki, które zaczynają się od napisu podanego przez użytkownika.
Użyj do tego DQL i swojego repozytorium, do pobrania informacji użyj slugów.


ODP:

Zrobione, żeby pokazywał książki o id większym od zadanej liczby - moja praca:

W pliku boookController.php dajemy:
*/

    /**
     * @Route("/showEverything/")
     * @Template("showeverything.html.twig")
     */
public function newshowEverythingAction()
{

    $em = $this->getDoctrine()->getManager();
    $books = $em->getRepository('AppBundle:book\Book')->findBooksByIdGiven(0);
    return ['books' => $books];
    // return [];
}


    //ZMIANA:
    public function newshowEverythingAction(Request $request) {

        $em=$this->getDoctrine()->getManager();
        $books = $em->getRepository('AppBundle:book\Book')->findBooksByIdGiven(0);
        return ['books' => $books,
            'over_id' => $over_id];

    }

//W pliku BookRepository.php:

    namespace AppBundle\Repository\book;

    use Doctrine\ORM\EntityRepository;

    /**
     * BookRepository
     *
     * This class was generated by the Doctrine ORM. Add your own custom
     * repository methods below.
     */
    class BookRepository extends EntityRepository
    {

        #Wszystkie książki oid większym niż podane przez użytkownika.


        public function findBooksByIdGiven ($start_id) {

            //$em=$this->getDoctrine()->getEntityManager(); -> w prezentacji jest źle podane, powinniśmy od razu dać getEntityManager()
            $em=$this->getEntityManager();
            $books=$em->createQuery(
                'SELECT p FROM AppBundle:book\Book p WHERE p.id > :start_id ORDER BY p.id ASC')
            ->setParameter ("start_id", $start_id)
            ->getResult();

            return $books;
        }


    }


//W pliku showeverything.html.twig
/*
    {% block content %}
        <h2>{{ 'Wszystkie książki ' | trans }} </h2>

        {% for book in books %}
            <ul>
                <li>
                    <div>
                        {{ book.title }}


                    </div>
                </li>
            </ul>
        {% endfor %}
    {% endblock %}
*/
